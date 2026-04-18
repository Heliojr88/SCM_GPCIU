<?php
/**
 * Bootstrap central do SCM_GPCIU.
 *
 * Responsabilidades:
 *   - Configurar sessão com cookies seguros (HttpOnly, SameSite)
 *   - Abrir sessão e conexão PDO
 *   - Expor helpers de autenticação (requireLogin, requirePermissao)
 *   - Expor helper de escape de saída e()
 *
 * Todo arquivo público deve começar com:
 *     require __DIR__ . '/../app/bootstrap.php';
 *     requireLogin();              // ou requireLogin(1) para apenas admin
 *
 * Páginas de autenticação (login, cadastro, recuperação) devem chamar
 * apenas bootstrap sem requireLogin().
 */

require_once __DIR__ . '/pdo.php';

// Headers de segurança comuns. Aplicados antes de qualquer saída para
// evitar Clickjacking, MIME sniffing e vazamento de Referer cross-site.
if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: same-origin');
    header('X-XSS-Protection: 0');
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

if (session_status() === PHP_SESSION_NONE) {
    // Endurece o cookie de sessão antes de iniciá-la
    $cookieParams = [
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'httponly' => true,
        'samesite' => 'Lax',
    ];
    session_set_cookie_params($cookieParams);
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_start();
}

// Token CSRF por sessão, compartilhado entre todas as páginas autenticadas.
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Conexão global, reutilizada por todas as páginas
if (!isset($GLOBALS['_pdo'])) {
    $_pdo = new connectDB();
    $_pdo->conectar();
    $GLOBALS['_pdo'] = $_pdo;
}

/** Escapa texto para saída HTML segura. */
function e($value): string
{
    if ($value === null) {
        return '';
    }
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Usuário atual ou null se não autenticado. */
function currentUser(): ?array
{
    if (!isset($_SESSION['idUsuario'], $_SESSION['siape'])) {
        return null;
    }
    return [
        'idUsuario' => $_SESSION['idUsuario'],
        'siape'     => $_SESSION['siape'],
        'nome'      => $_SESSION['nome']      ?? '',
        'permissao' => $_SESSION['permissao'] ?? null,
    ];
}

/**
 * Garante que o usuário esteja autenticado. Opcionalmente exige uma permissão
 * específica (1 = admin/master, 2 = usuário comum).
 * Redireciona para login.php se não estiver logado ou sem permissão.
 */
function requireLogin(?int $permissaoExigida = null): void
{
    $user = currentUser();

    if ($user === null) {
        header('Location: login.php');
        exit;
    }

    if ($permissaoExigida !== null && (int) $user['permissao'] !== $permissaoExigida) {
        echo "<script>alert('Usuário sem permissão para acessar a funcionalidade!');window.location.href='index.php';</script>";
        exit;
    }
}

/** Retorna o PDO helper global criado pelo bootstrap. */
function pdoConn(): connectDB
{
    return $GLOBALS['_pdo'];
}

/** Retorna o token CSRF da sessão corrente. */
function csrf_token(): string
{
    return $_SESSION['csrf_token'] ?? '';
}

/** Ecoa um input hidden com o token CSRF, para incluir nos forms. */
function csrf_field(): void
{
    echo '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

/**
 * Valida o token CSRF do request. Aborta com 403 se inválido.
 * Deve ser chamada logo no início dos handlers que processam $_POST.
 */
function csrf_validate(): void
{
    $sent = $_POST['_csrf'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    $expected = $_SESSION['csrf_token'] ?? '';
    if ($expected === '' || !is_string($sent) || !hash_equals($expected, $sent)) {
        http_response_code(403);
        exit('Token CSRF inválido. Recarregue a página e tente novamente.');
    }
}

/**
 * Lê um inteiro de $_REQUEST/$_POST/$_GET com validação. Retorna $default se
 * ausente ou inválido. Use $source para restringir a origem: 'POST' ou 'GET'.
 */
function req_int(string $key, ?int $default = null, string $source = 'REQUEST'): ?int
{
    $src = req_source($source);
    if (!isset($src[$key])) {
        return $default;
    }
    $v = filter_var($src[$key], FILTER_VALIDATE_INT);
    return $v === false ? $default : $v;
}

/**
 * Lê um id positivo (>0). Retorna null se ausente, inválido ou não positivo.
 */
function req_id(string $key, string $source = 'REQUEST'): ?int
{
    $v = req_int($key, null, $source);
    return ($v !== null && $v > 0) ? $v : null;
}

/**
 * Lê uma string com trim e limite de comprimento. Retorna $default se ausente
 * ou não escalar. $maxLen = 0 desativa o corte.
 */
function req_str(string $key, string $default = '', string $source = 'REQUEST', int $maxLen = 500): string
{
    $src = req_source($source);
    if (!isset($src[$key]) || !is_scalar($src[$key])) {
        return $default;
    }
    $s = trim((string) $src[$key]);
    if ($maxLen > 0 && strlen($s) > $maxLen) {
        $s = substr($s, 0, $maxLen);
    }
    return $s;
}

/** Resolve a superglobal correspondente ao nome lógico. */
function req_source(string $source): array
{
    switch (strtoupper($source)) {
        case 'POST':    return $_POST;
        case 'GET':     return $_GET;
        case 'REQUEST': return $_REQUEST;
    }
    return $_REQUEST;
}

/** Retorna o IP do cliente, respeitando proxy reverso se configurado. */
function client_ip(): string
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return filter_var($ip, FILTER_VALIDATE_IP) ?: '0.0.0.0';
}

/** Caminho do arquivo JSON que guarda o contador do rate limit. */
function rate_limit_file(string $key): string
{
    $dir = __DIR__ . '/../storage/ratelimit';
    if (!is_dir($dir)) {
        @mkdir($dir, 0700, true);
    }
    return $dir . '/' . sha1($key) . '.json';
}

/**
 * Incrementa o contador do rate limit para $key e retorna true se o limite foi
 * atingido dentro da janela $windowSeconds.
 */
function rate_limit_hit(string $key, int $maxAttempts, int $windowSeconds): bool
{
    $file = rate_limit_file($key);
    $now = time();
    $data = ['count' => 0, 'first' => $now];

    if (is_file($file)) {
        $raw = @file_get_contents($file);
        $decoded = $raw !== false ? json_decode($raw, true) : null;
        if (is_array($decoded) && isset($decoded['first'], $decoded['count'])) {
            $data = $decoded;
        }
    }

    if ($now - (int) $data['first'] > $windowSeconds) {
        $data = ['count' => 0, 'first' => $now];
    }

    $data['count'] = (int) $data['count'] + 1;
    @file_put_contents($file, json_encode($data), LOCK_EX);

    return $data['count'] > $maxAttempts;
}

/** Zera o contador de rate limit (ex.: após login bem-sucedido). */
function rate_limit_reset(string $key): void
{
    $file = rate_limit_file($key);
    if (is_file($file)) {
        @unlink($file);
    }
}
