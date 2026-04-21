<?php

// ALTERADO: Helper central de upload de foto para padronizar validações e evitar falhas silenciosas.
function scmProcessMaterialPhoto($inputName = 'foto') {
    if (!isset($_FILES[$inputName]) || empty($_FILES[$inputName]['name'])) {
        return array(
            'ok' => true,
            'filename' => null,
            'message' => null
        );
    }

    $foto = $_FILES[$inputName];
    if (!isset($foto['error']) || $foto['error'] !== UPLOAD_ERR_OK) {
        return array(
            'ok' => false,
            'filename' => null,
            'message' => 'Falha no envio da imagem. Tente novamente.'
        );
    }

    $allowedExtensions = array('gif', 'bmp', 'png', 'jpg', 'jpeg');
    $ext = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExtensions, true)) {
        return array(
            'ok' => false,
            'filename' => null,
            'message' => 'Formato de imagem inválido. Use JPG, JPEG, PNG, GIF ou BMP.'
        );
    }

    $imageInfo = @getimagesize($foto['tmp_name']);
    if ($imageInfo === false) {
        return array(
            'ok' => false,
            'filename' => null,
            'message' => 'Arquivo enviado não é uma imagem válida.'
        );
    }

    $targetDir = __DIR__ . DIRECTORY_SEPARATOR . 'fotos';
    if (!is_dir($targetDir)) {
        // ALTERADO: Cria diretório de fotos automaticamente quando não existir.
        @mkdir($targetDir, 0775, true);
    }

    if (!is_dir($targetDir) || !is_writable($targetDir)) {
        return array(
            'ok' => false,
            'filename' => null,
            'message' => 'Diretório de fotos indisponível para escrita.'
        );
    }

    $filename = md5(uniqid((string)time(), true)) . '.' . $ext;
    $targetPath = $targetDir . DIRECTORY_SEPARATOR . $filename;
    if (!move_uploaded_file($foto['tmp_name'], $targetPath)) {
        return array(
            'ok' => false,
            'filename' => null,
            'message' => 'Não foi possível salvar a foto no servidor.'
        );
    }

    return array(
        'ok' => true,
        'filename' => $filename,
        'message' => null
    );
}
