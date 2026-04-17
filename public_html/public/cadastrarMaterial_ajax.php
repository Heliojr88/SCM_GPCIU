<?php
require __DIR__ . '/../app/bootstrap.php';
requireLogin();

$nome = $_SESSION['nome'];
if(isset($_REQUEST['localizacao']))
{
$localizacao = $_REQUEST['localizacao'];
$consultasublocal = $_pdo->getSubLocalizacao($localizacao);
    WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

?>
         <option value="<?=$sublocal['idSubLocalizacao']?>"> <td><?=$sublocal['subLocalizacao']?></td> </option>
<?php
    ENDWHILE;
}