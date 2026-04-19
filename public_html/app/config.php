<?php
/**
 * Carregamento de configuração a partir de variáveis de ambiente ou arquivo .env
 * (na raiz do projeto, fora do webroot). Em último caso, usa os valores hardcoded
 * de config.local.php (também fora do controle de versão).
 *
 * NENHUM segredo deve ser commitado neste arquivo.
 */

if (!function_exists('scm_load_env')) {
    function scm_load_env(string $path): void
    {
        if (!is_file($path) || !is_readable($path)) {
            return;
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            if (strpos($line, '=') === false) {
                continue;
            }
            [$key, $value] = explode('=', $line, 2);
            $key   = trim($key);
            $value = trim($value);
            if ((str_starts_with($value, '"') && str_ends_with($value, '"'))
                || (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
                $value = substr($value, 1, -1);
            }
            if (getenv($key) === false) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }
    }
}

// Procura .env subindo a partir do diretório do projeto.
$envCandidates = [
    __DIR__ . '/../../.env',
    __DIR__ . '/../.env',
];
foreach ($envCandidates as $candidate) {
    if (is_file($candidate)) {
        scm_load_env($candidate);
        break;
    }
}

// Fallback opcional: arquivo local (gitignored) que define as mesmas chaves via putenv().
$localConfig = __DIR__ . '/config.local.php';
if (is_file($localConfig)) {
    require_once $localConfig;
}

if (!function_exists('scm_env')) {
    function scm_env(string $key, ?string $default = null): ?string
    {
        $value = getenv($key);
        if ($value === false || $value === '') {
            return $default;
        }
        return $value;
    }
}

return [
    'db' => [
        'host'    => scm_env('DB_HOST', 'localhost'),
        'name'    => scm_env('DB_NAME', ''),
        'user'    => scm_env('DB_USER', ''),
        'pass'    => scm_env('DB_PASS', ''),
        'charset' => scm_env('DB_CHARSET', 'utf8mb4'),
    ],
    'email' => [
        'remetente' => scm_env('SCM_EMAIL_REMETENTE', 'scm@gpciu.com.br'),
    ],
    'siape_master' => scm_env('SCM_SIAPE_MASTER', ''),
];
