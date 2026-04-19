<?php
/**
 * Bootstrap dos testes do PHPUnit.
 *
 * Redireciona o diretório de armazenamento para um tmp isolado por execução
 * e carrega apenas os helpers puros (não bootstrap.php, que abre sessão e PDO).
 */

$storage = sys_get_temp_dir() . '/scm_gpciu_tests_' . bin2hex(random_bytes(4));
if (!is_dir($storage)) {
    mkdir($storage, 0700, true);
}
define('SCM_STORAGE_DIR', $storage);
define('SCM_UPLOAD_TEST_MODE', true);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../public_html/app/helpers.php';

register_shutdown_function(static function () use ($storage): void {
    if (!is_dir($storage)) {
        return;
    }
    $it = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($storage, \FilesystemIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($it as $entry) {
        $entry->isDir() ? @rmdir($entry->getPathname()) : @unlink($entry->getPathname());
    }
    @rmdir($storage);
});
