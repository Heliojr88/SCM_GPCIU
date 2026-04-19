<?php
/**
 * Helpers puros/stateless do SCM_GPCIU, testáveis de forma isolada.
 *
 * Este arquivo NÃO inicia sessão, NÃO abre PDO e NÃO emite headers. Ele
 * expõe funções que operam sobre os argumentos recebidos, sobre $_POST/$_GET
 * (lidos por referência) ou sobre o disco em diretórios parametrizados por
 * scm_storage_dir(). bootstrap.php é o ponto onde essas funções são
 * materializadas num request real.
 */

if (!function_exists('e')) {
    /** Escapa texto para saída HTML segura. */
    function e($value): string
    {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('req_source')) {
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
}

if (!function_exists('req_int')) {
    /**
     * Lê um inteiro de $_REQUEST/$_POST/$_GET com validação. Retorna $default
     * se ausente ou inválido. Use $source para restringir a origem.
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
}

if (!function_exists('req_id')) {
    /** Lê um id positivo (>0). Retorna null se ausente, inválido ou não positivo. */
    function req_id(string $key, string $source = 'REQUEST'): ?int
    {
        $v = req_int($key, null, $source);
        return ($v !== null && $v > 0) ? $v : null;
    }
}

if (!function_exists('req_str')) {
    /**
     * Lê uma string com trim e limite de comprimento. Retorna $default se
     * ausente ou não escalar. $maxLen = 0 desativa o corte.
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
}

if (!function_exists('client_ip')) {
    /** Retorna o IP do cliente ou 0.0.0.0 se indisponível/invalido. */
    function client_ip(): string
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        return filter_var($ip, FILTER_VALIDATE_IP) ?: '0.0.0.0';
    }
}

if (!function_exists('scm_storage_dir')) {
    /**
     * Diretório base de armazenamento. Pode ser sobrescrito em testes via
     * a constante SCM_STORAGE_DIR (definida antes do require).
     */
    function scm_storage_dir(): string
    {
        return defined('SCM_STORAGE_DIR') ? SCM_STORAGE_DIR : __DIR__ . '/../storage';
    }
}

if (!function_exists('scm_log')) {
    /** Escreve uma entrada JSON de log em <storage>/logs/app.log. */
    function scm_log(string $level, string $message, array $context = []): void
    {
        $dir = scm_storage_dir() . '/logs';
        if (!is_dir($dir)) {
            @mkdir($dir, 0700, true);
        }
        $entry = [
            'ts'      => date('c'),
            'level'   => $level,
            'message' => $message,
            'context' => $context,
            'ip'      => $_SERVER['REMOTE_ADDR'] ?? null,
            'user'    => $_SESSION['siape']      ?? null,
            'uri'     => $_SERVER['REQUEST_URI'] ?? null,
        ];
        @file_put_contents(
            $dir . '/app.log',
            json_encode($entry, JSON_UNESCAPED_UNICODE) . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}

if (!function_exists('rate_limit_file')) {
    /** Caminho do arquivo JSON que guarda o contador do rate limit. */
    function rate_limit_file(string $key): string
    {
        $dir = scm_storage_dir() . '/ratelimit';
        if (!is_dir($dir)) {
            @mkdir($dir, 0700, true);
        }
        return $dir . '/' . sha1($key) . '.json';
    }
}

if (!function_exists('rate_limit_hit')) {
    /**
     * Incrementa o contador do rate limit para $key e retorna true se o limite
     * foi atingido dentro da janela $windowSeconds.
     */
    function rate_limit_hit(string $key, int $maxAttempts, int $windowSeconds): bool
    {
        $file = rate_limit_file($key);
        $now  = time();
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
}

if (!function_exists('rate_limit_reset')) {
    /** Zera o contador de rate limit (ex.: após login bem-sucedido). */
    function rate_limit_reset(string $key): void
    {
        $file = rate_limit_file($key);
        if (is_file($file)) {
            @unlink($file);
        }
    }
}

if (!function_exists('upload_image')) {
    /**
     * Recebe um upload de imagem e grava em $destDir com nome aleatório.
     *
     * Validações: UPLOAD_ERR_OK, is_uploaded_file, tamanho máximo, MIME real
     * via finfo (whitelist jpeg/png/gif), extensão derivada do MIME.
     *
     * Retorna o nome do arquivo gerado em caso de sucesso, null se nenhum
     * arquivo foi enviado, ou null com mensagem em $errorOut em caso de falha.
     */
    function upload_image(string $fieldName, string $destDir, ?string &$errorOut = null, int $maxBytes = 2097152): ?string
    {
        $errorOut = null;

        if (!isset($_FILES[$fieldName]) || !is_array($_FILES[$fieldName])) {
            return null;
        }
        $file = $_FILES[$fieldName];

        if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errorOut = 'Falha no upload do arquivo (codigo ' . (int) $file['error'] . ').';
            return null;
        }

        $inTest = defined('SCM_UPLOAD_TEST_MODE') && SCM_UPLOAD_TEST_MODE;
        if (!$inTest && !is_uploaded_file($file['tmp_name'])) {
            $errorOut = 'Arquivo de upload invalido.';
            return null;
        }
        if (($file['size'] ?? 0) > $maxBytes) {
            $errorOut = 'Arquivo excede o tamanho maximo permitido.';
            return null;
        }

        $allowed = [
            'image/jpeg'  => 'jpg',
            'image/pjpeg' => 'jpg',
            'image/png'   => 'png',
            'image/gif'   => 'gif',
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']);
        if (!isset($allowed[$mime])) {
            $errorOut = 'Tipo de arquivo nao permitido.';
            return null;
        }

        if (!is_dir($destDir)) {
            if (!@mkdir($destDir, 0755, true) && !is_dir($destDir)) {
                $errorOut = 'Diretorio de destino indisponivel.';
                return null;
            }
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
        $dest     = rtrim($destDir, '/\\') . '/' . $filename;

        $ok = $inTest
            ? @rename($file['tmp_name'], $dest)
            : move_uploaded_file($file['tmp_name'], $dest);

        if (!$ok) {
            $errorOut = 'Falha ao mover o arquivo para o destino.';
            return null;
        }

        @chmod($dest, 0644);
        return $filename;
    }
}

if (!function_exists('scm_crypto_key')) {
    /**
     * Lê a chave simétrica da aplicação (32 bytes = 64 hex chars) da variável
     * de ambiente SCM_APP_KEY. Gere com: `php -r 'echo bin2hex(random_bytes(32));'`
     */
    function scm_crypto_key(): string
    {
        $hex = (string) (getenv('SCM_APP_KEY') ?: '');
        if (strlen($hex) !== 64 || !ctype_xdigit($hex)) {
            throw new \RuntimeException('SCM_APP_KEY ausente ou invalida (64 chars hex esperados).');
        }
        return hex2bin($hex);
    }
}

if (!function_exists('scm_encrypt')) {
    /**
     * Criptografa $plaintext usando sodium secretbox. Retorna string
     * 'v1:<base64(nonce|cipher)>' — segura para guardar em colunas TEXT.
     */
    function scm_encrypt(string $plaintext): string
    {
        $nonce  = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $cipher = sodium_crypto_secretbox($plaintext, $nonce, scm_crypto_key());
        return 'v1:' . base64_encode($nonce . $cipher);
    }
}

if (!function_exists('scm_decrypt')) {
    /** Decripta string produzida por scm_encrypt. Retorna null se inválida. */
    function scm_decrypt(string $ciphertext): ?string
    {
        if (strncmp($ciphertext, 'v1:', 3) !== 0) {
            return null;
        }
        $raw = base64_decode(substr($ciphertext, 3), true);
        if ($raw === false || strlen($raw) <= SODIUM_CRYPTO_SECRETBOX_NONCEBYTES) {
            return null;
        }
        $nonce  = substr($raw, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $cipher = substr($raw, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $plain  = sodium_crypto_secretbox_open($cipher, $nonce, scm_crypto_key());
        return $plain === false ? null : $plain;
    }
}

if (!function_exists('scm_hmac')) {
    /**
     * HMAC determinístico para permitir lookups indexados em colunas
     * encriptadas (ex.: armazenar HMAC do CPF ao lado do ciphertext).
     */
    function scm_hmac(string $value): string
    {
        return hash_hmac('sha256', $value, scm_crypto_key());
    }
}
