<?php
session_start();

require("../app/pdo.php");

$_pdo = new connectDB();
$_pdo->conectar();

$nome = $_SESSION['nome'];

 		 
$origem = $_POST = ['origem'];
$destino = $_POST = ['destino'];
$quantidade = $_POST = ['quantidade'];
$idmaterial = $_POST['material'];

if($origem == $destino){
	echo"<script language='javascript' type='text/javascript'>alert('A Origem deve ser diferente do destino!');</script>";
 }
 else{
	$banco = "agenciageeks05"; 
    $senhaBanco = "17gbmDeposito"; 
	$usuarioBanco = "agenciageeks05";
    $host = "mysql.agenciageeks.com.br"; 
   // $host = "mysql08-farm61.uni5.net";
 
	//Conexão à base de dados 
	$connect = mysqli_connect($host, $banco,$senhaBanco,$banco)
	or die("Incapaz de se conectar ao servidor MySQL (<b>Host</b>: $host | <b>Base</b>: $banco)"); 
	//echo "Conectado ao servidor Mysql (<b>Host</b>: $host | <b>Base</b>: $banco)<br>"; 
	
	if(!$connect){
		
		echo "Falha na conexão ao banco de dados, erro: ".PHP_EOL;
		echo "Debuggin errno: ".mysqli_connect_errno().PHP_EOL;
		echo "Debuggin errno: ".mysqli_connect_errno().PHP_EOL;
		exit;
	}
	
	$query = "SELECT COUNT(Quantidade) FROM material WHERE idGrupoMaterial = 72";
	$verifica = mysql_query($query);
    $verifica = mysql_fetch_assoc($verifica);
	$verifica = $verifica['COUNT(Quantidade)'];
	
 if(($quantidade > $verifica) || ($quantidade <= 0)) {
	 echo"<script language='javascript' type='text/javascript'>alert('$query $verifica $quantidade,A Quantidade a ser transferida é maior do que a quantidade existente ou é Inválida!');</script>";
	 die();
 }
 else{
	 $query = "UPDATE material set Localizacao_idLocalizacao = '$destino'
				 where idMaterial in(
     				SELECT * from (
    								select idMaterial  from material
					 				where idGrupoMaterial = $idmaterial
                     				order BY idMaterial  desc limit $quantidade
                      			   )
    							as t);";
     try{
		 $nome = mysql_query($query);
			 echo"<script language='javascript' type='text/javascript'>alert('Material Tramitado com Sucesso!');</script>";
		}
		catch(Exception $e){
		    die("erro ao criar a tramitar, erro ".$e->getMessage());
			
		}
	 }								
 }
	
 


if((!isset ($_SESSION['siape']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['siape']);
	unset($_SESSION['senha']);
	
	echo"<script language='javascript' type='text/javascript'>alert('Gentileza efetue login no Sistema');</script>";
	
	header('location:login.php');
	

}
//echo $_POST['materiais'];
?>
