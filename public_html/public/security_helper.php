<?php

require_once(__DIR__ . '/../app/config.php');

// ALTERADO: Garante token CSRF único por sessão.
function scmEnsureCsrfToken() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// ALTERADO: Campo hidden padrão para formulários protegidos por CSRF.
function scmCsrfInput() {
    $token = scmEnsureCsrfToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}

// ALTERADO: Validação CSRF com comparação em tempo constante.
function scmValidateCsrfToken() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $tokenSession = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '';
    $tokenRequest = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
    return !empty($tokenSession) && !empty($tokenRequest) && hash_equals($tokenSession, $tokenRequest);
}

// ALTERADO: Endurecimento de sessão por inatividade.
function scmEnforceSessionTimeout($redirect = 'login.php') {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $config = scmConfig();
    $timeout = (int)$config['session_timeout'];
    if ($timeout <= 0) {
        $timeout = 1800;
    }

    $now = time();
    if (isset($_SESSION['last_activity']) && ($now - (int)$_SESSION['last_activity']) > $timeout) {
        session_unset();
        session_destroy();
        header('Location:' . $redirect);
        exit;
    }
    $_SESSION['last_activity'] = $now;
}

// ALTERADO: Rotaciona ID da sessão no login para reduzir risco de fixation.
function scmRotateSessionOnLogin() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    session_regenerate_id(true);
    $_SESSION['session_created_at'] = time();
}

// ALTERADO: Verifica limitação progressiva de tentativas por usuário+IP.
function scmLoginRateLimitCheck($siape) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $config = scmConfig();
    $maxAttempts = max(1, (int)$config['login_max_attempts']);
    $lockSeconds = max(1, (int)$config['login_lock_seconds']);
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
    $key = 'login_rl_' . md5((string)$siape . '|' . $ip);

    if (!isset($_SESSION[$key])) {
        return array('blocked' => false, 'retry_after' => 0, 'key' => $key);
    }

    $data = $_SESSION[$key];
    $attempts = isset($data['attempts']) ? (int)$data['attempts'] : 0;
    $blockedUntil = isset($data['blocked_until']) ? (int)$data['blocked_until'] : 0;

    if ($blockedUntil > time()) {
        return array('blocked' => true, 'retry_after' => $blockedUntil - time(), 'key' => $key);
    }

    if ($attempts >= $maxAttempts) {
        $_SESSION[$key]['blocked_until'] = time() + $lockSeconds;
        return array('blocked' => true, 'retry_after' => $lockSeconds, 'key' => $key);
    }

    return array('blocked' => false, 'retry_after' => 0, 'key' => $key);
}

// ALTERADO: Registra falha de autenticação para bloqueio progressivo.
function scmLoginRateLimitFail($key) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = array('attempts' => 0, 'blocked_until' => 0);
    }
    $_SESSION[$key]['attempts'] = (int)$_SESSION[$key]['attempts'] + 1;
}

// ALTERADO: Limpa contador de tentativas após login bem-sucedido.
function scmLoginRateLimitReset($key) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    unset($_SESSION[$key]);
}
