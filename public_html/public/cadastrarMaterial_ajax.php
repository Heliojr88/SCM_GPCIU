<?php
require __DIR__ . '/../app/bootstrap.php';
requireLogin();

$nome = $_SESSION['nome'];
if(isset($_REQUEST['localizacao']))
{
$localizacao = req_id('localizacao');
if ($localizacao === null) { exit; }
$consultasublocal = $_pdo->getSubLocalizacao($localizacao);
    WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

?>
         <option value="<?= e($sublocal['idSubLocalizacao']) ?>"> <td><?= e($sublocal['subLocalizacao']) ?></td> </option>
<?php
    ENDWHILE;
}