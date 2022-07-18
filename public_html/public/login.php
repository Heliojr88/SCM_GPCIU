<?php 

session_start();

require("../app/pdo.php");

$_pdo = new connectDB();
$_pdo->conectar();


if(!empty($_POST) or !empty($_GET)){
	if(isset($_GET['q']) and $_GET['q'] == 'logout'){
		session_destroy();
		header("Location:../login.php");	
	}

	$siape = $_POST['siape'];
	$entrar = $_POST['login'];
	$senha = md5($_POST['senha']);

	if (isset($entrar)) {
		$consulta = $_pdo->login($siape, $senha);
		$verifica = $consulta->fetch(PDO::FETCH_ASSOC);
                //echo $verifica;
				
		if (!$verifica){
		//  echo"<script language='javascript' type='text/javascript'>alert('Por motivos de segurança, se esse é o seu Primeiro Acesso, entre em contato com o Cb Martins para ativar o seu usuário. Caso contrário, verifique se o seu Login/Senha estão corretos!');window.location.href='login.php';</script>";
			echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.php';</script>";
			die();
		}else if($verifica['ativo'] == 0){
			echo"<script language='javascript' type='text/javascript'>alert('Por motivos de segurança, se esse é o seu Primeiro Acesso, entre em contato com o Sgt Delvan para ativar o seu usuário.');window.location.href='login.php';</script>";
		}
		else{
		 
			$res[] = $verifica['NomeUsuario'];					
			$res[] = $verifica['idUsuario'];					
			$res[] = $verifica['Permissao_idPermissao'];
			
			//print_r ($verifica);
			//print_r($res);					
			
			$_SESSION['nome'] = $res[0];
			$_SESSION['idUsuario'] = $res[1];
			$_SESSION['senha'] = $senha;
			$_SESSION['siape'] = $siape;
			$_SESSION['permissao'] = $res[2];
								
			setcookie("login",$login);
			header("Location:index6.php");					

		}
	}
}
	
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GPCIU - SCM </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
		  <div align="center">
	  <img src="images/logo.png">
	  </div>
            <form method="POST" action="login.php" name="login">
              <h1>SEJA BEM VINDO	</h1>
              <div>
                <input type="text" class="form-control" name="siape" id="siape" placeholder="siape" required="*" />
              </div>
              <div>
                <input type="password" class="form-control" name="senha" id="senha" placeholder="senha" required="*" />
              </div>
              <div >
               <!-- <a class="btn btn-default submit" href="index.html">Entrar</a>-->
			   <input type="submit" value="Entrar" id="login" name="login">
                <a class="reset_pass" href="recuperaSenha.php">Esqueceu a senha?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                    <a href="http://gremiogpciu.wixsite.com/gpciu" target="blank">Transparência do Grêmio</a>
                </p>
                <p class="change_link">Novo usuário?
                  <a href="form.php" class="to_register"> Crie a sua conta </a>
                </p>
				
		<!--<p class="change_link">
				<img src="images\android.jpg">
                  <a href="arquivos\SCM.apk" class="to_register"> Baixe o Aplicativo do SCM Android </a>
                </p>-->
				
		<p class="change_link">
				<img src="images\pdf.png">
                  <a href="arquivos\Tutorial SCM.pdf" target="_blank" class="to_register"> Baixe o tutorial do SCM </a>
                </p>	
                
                <p class="change_link">
                    <img src="images\pdf.png">
                    <a href="arquivos\leiaute-deposito.pdf" target="_blank" class="to_register"> Informações sobre o novo Leiaute </a>
                </p>
				
                <div class="clearfix"></div>
                <br />

                <div>
                  <h2>Sistema de Controle de Materiais SCM</h2>
				  <small><?php
					$handle = file("sobre.php");
					echo $handle[1];
					echo $handle[2];
				  ?></small>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Já é um usuário?
                  <a href="#signin" class="to_register"> Entre no Sistema </a>
                </p>

                <div class="clearfix"></div>
                <br />

                
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

