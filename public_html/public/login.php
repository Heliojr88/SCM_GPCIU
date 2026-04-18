<?php
require __DIR__ . '/../app/bootstrap.php';

if (isset($_GET['q']) && $_GET['q'] === 'logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    csrf_validate();
    $siape = req_str('siape', '', 'POST', 30);
    $senha = (string) ($_POST['senha'] ?? '');

    if ($siape === '' || $senha === '') {
        echo "<script>alert('Informe SIAPE e senha.');window.location.href='login.php';</script>";
        exit;
    }

    // Rate limit: 5 tentativas por IP+siape em 15 minutos.
    $rlKey = 'login:' . client_ip() . ':' . strtolower($siape);
    if (rate_limit_hit($rlKey, 5, 900)) {
        echo "<script>alert('Muitas tentativas de login. Aguarde 15 minutos e tente novamente.');window.location.href='login.php';</script>";
        exit;
    }

    $usuario = $_pdo->login($siape, $senha);

    if (!$usuario) {
        echo "<script>alert('Login e/ou senha incorretos');window.location.href='login.php';</script>";
        exit;
    }

    if ((int) $usuario['ativo'] === 0) {
        echo "<script>alert('Por motivos de segurança, se esse é o seu Primeiro Acesso, entre em contato com o administrador para ativar o seu usuário.');window.location.href='login.php';</script>";
        exit;
    }

    // Previne session fixation
    session_regenerate_id(true);

    $_SESSION['nome']      = $usuario['NomeUsuario'];
    $_SESSION['idUsuario'] = $usuario['idUsuario'];
    $_SESSION['siape']     = $usuario['Siape'];
    $_SESSION['permissao'] = $usuario['Permissao_idPermissao'];

    rate_limit_reset($rlKey);

    header('Location: index6.php');
    exit;
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
              <?php csrf_field(); ?>
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
		<p class="change_link">
				<img src="images\pdf.png">
                  <a href="arquivos\Tutorial SCM.pdf" target="_blank" class="to_register"> Baixe o tutorial do SCM </a>
                </p>	
                
                <p class="change_link">
                    <img src="images\pdf.png">
                    <a href="arquivos\leiaute-deposito.pdf" target="_blank" class="to_register"> Informações sobre o novo Layout </a>
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

