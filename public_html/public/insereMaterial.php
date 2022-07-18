<?php
session_start();
/*
require("../app/pdo.php");

$_pdo = new connectDB();
$_pdo->conectar();
*/


	function insereMaterial($descricao,$quantidade,$patrimonio,$categoria,$localizacao,$tipomaterial,$nome_imagem,$siape){
            $con = new PDO('mysql:host=mysql.agenciageeks.com.br;
			                        dbname=agenciageeks05', 'agenciageeks05', '17gbmDeposito');
		$sql = "SELECT * FROM material WHERE NumPatrimonio = '$patrimonio'";
		$resultado = $con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
		$resultado->execute();
		$nResultado = $resultado->fetchColumn();
		
		if($nResultado > 1){
			return 0; // erro 0 patrimonio já cadastrado
		}
		
		try{
			$sql = "INSERT into material (categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao, NumPatrimonio, Quantidade,Situacaomat_idSituacao,Usuarios_Siape, TipoMaterial_idTipoMaterial,fotoMaterial)
				  VALUES($categoria,'$descricao',$localizacao,'$patrimonio',1,1,$siape,$tipomaterial,'$nome_imagem')";
			
			$exec = $con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
			$exec->execute();
			$ultimoid = $con->lastInsertId();
			$sql1 = "update material set idGrupoMaterial = $ultimoid where idMaterial = $ultimoid";
			$exec = $con->prepare($sql1) OR trigger_error($con->error, E_USER_ERROR);
			$exec->execute();
			
			while ($quantidade -1){
				
				$sql2 = "INSERT into material (idGrupoMaterial, categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao, NumPatrimonio, Quantidade,Situacaomat_idSituacao,Usuarios_Siape, TipoMaterial_idTipoMaterial,fotoMaterial)
				  VALUES('$ultimoid','$categoria','$descricao',$localizacao,'$patrimonio',1,1,$siape,$tipomaterial,'".$nome_imagem."')";
				 
				$exec = $con->prepare($sql2) OR trigger_error($con->error, E_USER_ERROR);
				$exec->execute();
				
				$quantidade = ($quantidade - 1);
			}
			return true;
		}
		catch(Exception $e){
		    die("erro ao cadastrar, erro ".$e->getMessage());			
		}
		
	}





$nome = $_SESSION['nome'];
$siape = $_SESSION['siape'];

if((!isset ($_SESSION['siape']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['siape']);
	unset($_SESSION['senha']);
	
	echo"<script language='javascript' type='text/javascript'>alert('Gentileza efetue login no Sistema');</script>";
	
	header('location:login.php');
}

     error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    
   if($_SESSION['permissao'] != 1){
	   echo"<script language='javascript' type='text/javascript'>alert('Usuário sem permissão para acessar a funcionalidade!');window.location.href='index.php';</script>";
   }	
	
	 if(!empty($_POST) or !empty($_GET)){
		
	$descricao = $_POST['descricao'];	 	
	$quantidade = $_POST['quantidade'];
	$patrimonio = $_POST['patrimonio'];
	$categoria = $_POST['categoria'];
	$localizacao = $_POST['localizacao'];
	$tipomaterial = $_POST['tipomaterial'];
	$foto = $_FILES["foto"];
    $error;
	
	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
		
		// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     	   $error[1] = "Isso não é uma imagem.";
   	 	}
	/*	
		// Largura máxima em pixels
		$largura = 150;
		// Altura máxima em pixels
		$altura = 180;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 1000;
 	
		// Pega as dimensões da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
		
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
		}
 
		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > $altura) {
			$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
		}
		
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
   		 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
		}
 */
		// Se não houver nenhum erro
		if (count($error) == 0) {
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
 
        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficará a imagem
        	 $caminho_imagem = "fotos/" . $nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			unset($foto);
		}    
	}	
  
	$insere = insereMaterial($descricao,$quantidade,$patrimonio,$categoria,$localizacao,$tipomaterial,$nome_imagem,$siape);

	
	 if ($insere==0){
		echo"<script language='javascript' type='text/javascript'>alert('Material já cadastrado no sistema');window.location.href='material.php';</script>";
		die();
	}else if ($insere){
		echo"<script language='javascript' type='text/javascript'>alert('Material cadastrado com sucesso');window.location.href='material.php';</script>";
		die();
	}

} else {
    
    header('location:index.php');
}