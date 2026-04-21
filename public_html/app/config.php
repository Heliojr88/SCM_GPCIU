<?php

// ALTERADO: Centraliza leitura de configuração via variáveis de ambiente do SCM.
function scmEnv($key, $default = null) {
    $value = getenv($key);
    if ($value === false || $value === '') {
        return $default;
    }
    return $value;
}

// ALTERADO: Reúne configuração do banco em um único ponto.
function scmConfig() {
    return array(
        // ALTERADO: Remove fallback sensível para forçar uso de variáveis de ambiente.
        'db_host' => scmEnv('SCM_DB_HOST'),
        'db_name' => scmEnv('SCM_DB_NAME'),
        'db_user' => scmEnv('SCM_DB_USER'),
        'db_pass' => scmEnv('SCM_DB_PASS'),
        // ALTERADO: Controle de compatibilidade de hash legado MD5 no login.
        'auth_allow_legacy_md5' => (int) scmEnv('SCM_AUTH_ALLOW_LEGACY_MD5', '1'),
        // ALTERADO: Configura timeout de sessão por inatividade.
        'session_timeout' => (int) scmEnv('SCM_SESSION_TIMEOUT', '1800'),
        // ALTERADO: Configura hardening de tentativas de login.
        'login_max_attempts' => (int) scmEnv('SCM_LOGIN_MAX_ATTEMPTS', '5'),
        'login_lock_seconds' => (int) scmEnv('SCM_LOGIN_LOCK_SECONDS', '300')
    );
}
