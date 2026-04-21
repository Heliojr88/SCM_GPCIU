<?php

// ALTERADO: Helper central para padronizar alertas de UI com suporte ao getLastResponse() do domínio.
function scmUiAlert($message, $redirect = null) {
    $safeMessage = addslashes($message);
    echo "<script language='javascript' type='text/javascript'>alert('{$safeMessage}');";
    if (!empty($redirect)) {
        $safeRedirect = addslashes($redirect);
        echo "window.location.href='{$safeRedirect}';";
    }
    echo "</script>";
}

// ALTERADO: Extrai mensagem estruturada de domínio quando disponível e aplica fallback legível.
function scmDomainMessage($pdo, $fallbackMessage) {
    if (!is_object($pdo) || !method_exists($pdo, 'getLastResponse')) {
        return $fallbackMessage;
    }

    $response = $pdo->getLastResponse();
    if (is_array($response) && isset($response['message']) && !empty($response['message'])) {
        return $response['message'];
    }

    return $fallbackMessage;
}
