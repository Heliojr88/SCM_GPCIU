<?php
session_start();

require("../app/pdo.php");

$_pdo = new connectDB();
$_pdo->conectar();

$nome = $_SESSION['nome'];

if((!isset ($_SESSION['siape']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['siape']);
	unset($_SESSION['senha']);
	
	echo("<script language='javascript' type='text/javascript'>alert('Gentileza realizar login no Sistema!');window.location.href='login.php';</script>");
}

 		 
if(isset($_REQUEST['origem']))
{
$origem = $_REQUEST['origem'];
			
$consulta = $_pdo->getMaterialAll($origem);
  WHILE($material = $consulta->fetch(PDO::FETCH_ASSOC)):

?>

     <option value="<?=$material['idGrupoMaterial'].'/'.$material['sublocalizacao_idSubLocalizacao']?>">
				<td><?=$material['DescricaoMat']?></td>
				(&nbsp<td><?=$material['Localizacao']?></td>
				 &nbsp<td><?=$material['subLocalizacao']?></td>
				 )&nbspQtd:<td><?=$material['Quantidade']?></td>
				  &nbspPat:&nbsp<td><?=$material['NumPatrimonio']?></td>
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
     <option value="<?=$sublocal['idSubLocalizacao']?>"> <td><?=$sublocal['subLocalizacao']?></td> </option>

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
     <option value="<?=$sublocal['idSubLocalizacao']?>"> <td><?=$sublocal['subLocalizacao']?></td> </option>

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
     <option value="<?=$sublocal['idSubLocalizacao']?>"> <td><?=$sublocal['subLocalizacao']?></td> </option>

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
     <option value="<?=$sublocal['idSubLocalizacao']?>"> <td><?=$sublocal['subLocalizacao']?></td> </option>

<?php
ENDWHILE;
}
?>



?>     
     
    
  
