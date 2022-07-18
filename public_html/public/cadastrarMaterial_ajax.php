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