<?php
/**
 * Backfill de SIAPE/CPF criptografados na tabela usuarios.
 *
 * Pre-requisitos:
 *   1. SCM_APP_KEY exportada (64 chars hex).
 *   2. Migration DB/migrations/002_pii_columns.sql aplicada.
 *   3. Rodar em horario de baixa carga — faz UPDATE linha-a-linha.
 *
 * Uso:
 *   SCM_APP_KEY=... php bin/backfill_pii.php
 *   SCM_APP_KEY=... php bin/backfill_pii.php --dry-run
 *   SCM_APP_KEY=... php bin/backfill_pii.php --batch=500
 *
 * Idempotente: pula registros que ja tem siape_cipher populado.
 *
 * Proximo passo apos rodar (em outra migration):
 *   ALTER TABLE usuarios DROP COLUMN Siape, DROP COLUMN CPF;
 *   UPDATE app para ler/gravar exclusivamente nas colunas *_cipher/*_hmac.
 */

declare(strict_types=1);

$root = dirname(__DIR__);
require $root . '/public_html/app/helpers.php';
require $root . '/public_html/app/pdo.php';

$dry   = in_array('--dry-run', $argv, true);
$batch = 200;
foreach ($argv as $a) {
    if (preg_match('/^--batch=(\d+)$/', $a, $m)) {
        $batch = max(1, (int) $m[1]);
    }
}

try {
    scm_crypto_key();
} catch (\Throwable $e) {
    fwrite(STDERR, 'SCM_APP_KEY invalida: ' . $e->getMessage() . "\n");
    exit(2);
}

$db = new connectDB();
$db->conectar();
$pdo = $db->pdo();

$offset = 0;
$done   = 0;
$skip   = 0;

do {
    $sel = $pdo->prepare(
        'SELECT idUsuario, Siape, CPF
           FROM usuarios
          WHERE (siape_cipher IS NULL OR cpf_cipher IS NULL)
          ORDER BY idUsuario
          LIMIT :lim OFFSET :off'
    );
    $sel->bindValue(':lim', $batch, \PDO::PARAM_INT);
    $sel->bindValue(':off', $offset, \PDO::PARAM_INT);
    $sel->execute();
    $rows = $sel->fetchAll(\PDO::FETCH_ASSOC);

    if (!$rows) {
        break;
    }

    $upd = $pdo->prepare(
        'UPDATE usuarios
            SET siape_cipher = :sc, siape_hmac = :sh,
                cpf_cipher   = :cc, cpf_hmac   = :ch
          WHERE idUsuario = :id'
    );

    foreach ($rows as $r) {
        $id    = (int) $r['idUsuario'];
        $siape = trim((string) $r['Siape']);
        $cpf   = trim((string) $r['CPF']);

        if ($siape === '' && $cpf === '') {
            $skip++;
            continue;
        }

        $payload = [
            ':sc' => $siape !== '' ? scm_encrypt($siape) : null,
            ':sh' => $siape !== '' ? scm_hmac($siape)    : null,
            ':cc' => $cpf   !== '' ? scm_encrypt($cpf)   : null,
            ':ch' => $cpf   !== '' ? scm_hmac($cpf)      : null,
            ':id' => $id,
        ];

        if ($dry) {
            echo "[dry-run] id={$id} siape={$siape} cpf={$cpf}\n";
        } else {
            $upd->execute($payload);
        }
        $done++;
    }

    $offset += $batch;
    echo "Lote processado: +{$batch} (total criptografado: {$done}, puladas: {$skip})\n";
} while (count($rows) === $batch);

echo ($dry ? '[dry-run] ' : '') . "Concluido. {$done} registros criptografados, {$skip} vazios pulados.\n";
