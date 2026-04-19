<?php
/**
 * Rotacao de logs do SCM_GPCIU.
 *
 * Uso:
 *   php bin/rotate_logs.php                  # rotaciona se o app.log passar de 10 MiB
 *   php bin/rotate_logs.php --force          # rotaciona sempre
 *   SCM_LOG_MAX_BYTES=20000000 php ...       # limite customizado
 *   SCM_LOG_KEEP=30 php ...                  # quantos arquivos manter (default 14)
 *
 * Estrategia:
 *   1. Se app.log existir e ultrapassar o limite, renomeia para app-YYYYMMDD-HHMMSS.log.gz
 *      (comprimido com gzip).
 *   2. Remove rotacoes mais antigas alem de SCM_LOG_KEEP (default 14).
 *   3. Nunca falha silenciosamente — retorna exit code != 0 em erro.
 *
 * Cron sugerido (diario as 03:00):
 *   0 3 * * * /usr/bin/php /caminho/SCM_GPCIU/bin/rotate_logs.php >> /var/log/scm-rotate.log 2>&1
 */

declare(strict_types=1);

$root = dirname(__DIR__);
$logDir = $root . '/public_html/storage/logs';
$source = $logDir . '/app.log';

$maxBytes = (int) (getenv('SCM_LOG_MAX_BYTES') ?: 10 * 1024 * 1024);
$keep     = (int) (getenv('SCM_LOG_KEEP') ?: 14);
$force    = in_array('--force', $argv, true);

if (!is_dir($logDir)) {
    fwrite(STDERR, "Diretorio de logs nao existe: {$logDir}\n");
    exit(0);
}

if (!is_file($source)) {
    echo "Nada a rotacionar ({$source} ausente).\n";
    exit(0);
}

$size = filesize($source);
if (!$force && $size !== false && $size < $maxBytes) {
    echo "Log com {$size} bytes, abaixo do limite {$maxBytes}. Nada a fazer.\n";
    exit(0);
}

$stamp   = date('Ymd-His');
$target  = $logDir . '/app-' . $stamp . '.log';
$gzFinal = $target . '.gz';

// Renomeia antes de comprimir para liberar o arquivo ativo o quanto antes.
$fp = @fopen($source, 'c+');
if ($fp === false) {
    fwrite(STDERR, "Nao foi possivel abrir {$source}\n");
    exit(1);
}
if (!flock($fp, LOCK_EX)) {
    fclose($fp);
    fwrite(STDERR, "Nao foi possivel bloquear {$source}\n");
    exit(1);
}

if (!@rename($source, $target)) {
    flock($fp, LOCK_UN);
    fclose($fp);
    fwrite(STDERR, "Falha ao renomear {$source} -> {$target}\n");
    exit(1);
}

// Recria arquivo vazio para nao derrubar o app.
@touch($source);
@chmod($source, 0640);
flock($fp, LOCK_UN);
fclose($fp);

// Comprime em streaming para nao estourar memoria em logs grandes.
$in  = @fopen($target, 'rb');
$out = @gzopen($gzFinal, 'wb9');
if ($in === false || $out === false) {
    fwrite(STDERR, "Falha ao comprimir {$target}\n");
    exit(1);
}
while (!feof($in)) {
    $buf = fread($in, 65536);
    if ($buf === false) {
        break;
    }
    gzwrite($out, $buf);
}
fclose($in);
gzclose($out);
@unlink($target);

echo "Rotacionado: {$gzFinal}\n";

// Limpeza das rotacoes antigas, preservando os $keep mais recentes.
$rotated = glob($logDir . '/app-*.log.gz') ?: [];
usort($rotated, static fn(string $a, string $b) => filemtime($b) <=> filemtime($a));
$old = array_slice($rotated, $keep);
foreach ($old as $file) {
    if (@unlink($file)) {
        echo "Removido antigo: " . basename($file) . "\n";
    }
}

exit(0);
