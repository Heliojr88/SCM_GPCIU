<?php
require __DIR__ . '/../app/bootstrap.php';
requireLogin();

$nome = $_SESSION['nome'];

 		 
if(isset($_REQUEST['origem']))
{
$origem = $_REQUEST['origem'];
			
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
$origem = $_REQUEST['origem'];
			
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
$origem = $_REQUEST['subOrigem'];
			
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
$destino = $_REQUEST['subDestino'];
			
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
$destino = $_REQUEST['destino'];
			
$consultasublocal = $_pdo->getSubLocalizacao($destino);
  WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

?>
     <option value="<?= e($sublocal['idSubLocalizacao']) ?>"> <td><?= e($sublocal['subLocalizacao']) ?></td> </option>

<?php
ENDWHILE;
}
?>



?>     
     
    
  
