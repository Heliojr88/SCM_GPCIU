<?php
require __DIR__ . '/../app/bootstrap.php';
requireLogin();

$nome = $_SESSION['nome'];

 		 
if(isset($_REQUEST['origem']))
{
$origem = req_id('origem');
if ($origem === null) { exit; }
$consulta = $_pdo->getMaterialAll($origem);
  WHILE($material = $consulta->fetch(PDO::FETCH_ASSOC)):

?>

     <option value="<?= e($material['idGrupoMaterial'].'/'.$material['sublocalizacao_idSubLocalizacao']) ?>">
				<td><?= e($material['DescricaoMat']) ?></td>
				(&nbsp<td><?= e($material['Localizacao']) ?></td>
				 &nbsp<td><?= e($material['subLocalizacao']) ?></td>
				 )&nbspQtd:<td><?= e($material['Quantidade']) ?></td>
				  &nbspPat:&nbsp<td><?= e($material['NumPatrimonio']) ?></td>
     </option>

<?php
ENDWHILE;
}
?>

<?php
if(isset($_REQUEST['origem']))
{
$origem = req_id('origem');
if ($origem === null) { exit; }
$consultasublocal = $_pdo->getSubLocalizacao($origem);
  WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

?>
     <option value="<?= e($sublocal['idSubLocalizacao']) ?>"> <td><?= e($sublocal['subLocalizacao']) ?></td> </option>

<?php
ENDWHILE;
}
?> 
     
<?php
if(isset($_REQUEST['subOrigem']))
{
$origem = req_id('subOrigem');
if ($origem === null) { exit; }
$consultasublocal = $_pdo->getSubLocalizacao($origem);
  WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

?>
     <option value="<?= e($sublocal['idSubLocalizacao']) ?>"> <td><?= e($sublocal['subLocalizacao']) ?></td> </option>

<?php
ENDWHILE;
}
?>

<?php
if(isset($_REQUEST['subDestino']))
{
$destino = req_id('subDestino');
if ($destino === null) { exit; }
$consultasublocal = $_pdo->getSubLocalizacao($destino);
  WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

?>
     <option value="<?= e($sublocal['idSubLocalizacao']) ?>"> <td><?= e($sublocal['subLocalizacao']) ?></td> </option>

<?php
ENDWHILE;
}
?>

<?php
if(isset($_REQUEST['destino']))
{
$destino = req_id('destino');
if ($destino === null) { exit; }
$consultasublocal = $_pdo->getSubLocalizacao($destino);
  WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

?>
     <option value="<?= e($sublocal['idSubLocalizacao']) ?>"> <td><?= e($sublocal['subLocalizacao']) ?></td> </option>

<?php
ENDWHILE;
}
?>



?>     
     
    
  
