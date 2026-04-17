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
