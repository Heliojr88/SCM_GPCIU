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
        'db_pass' => scmEnv('SCM_DB_PASS')
    );
}
