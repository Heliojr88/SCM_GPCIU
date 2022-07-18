<?php
class connectDB{

protected static $con;


function conectar(){


$host = "localhost";
$banco = "gpciuc95_deposito";
$usuarioBanco = "gpciuc95_db";
$senhaBanco = "dbadmin123";

    try{
        $opcoes = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        );

        self::$con = new PDO("mysql:dbname=$banco;host=$host", $usuarioBanco, $senhaBanco,$opcoes);

    }catch(Exception $e){
           echo "Falha na conexão ao banco de dados, erro: ".PHP_EOL . $e->getMessage();
    }
}

//retorna todos os materiais
function getMaterial() {

$sql = "SELECT COUNT(m.Quantidade) as Quantidade,
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat,
m.idGrupoMaterial,
m.Localizacao_idLocalizacao,
m.NumPatrimonio

        FROM material m, localizacao l, tipomaterial tm, categoria c,
        situacaomat sm
                WHERE  m.Localizacao_idLocalizacao = l.idLocalizacao
                and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
                and m.Categoria_idCategoria = c.idCategoria
                and m.Situacaomat_idSituacao = sm.idSituacaoMat

        GROUP by
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat,
m.idGrupoMaterial,
        m.Localizacao_idLocalizacao,
        m.NumPatrimonio";

$sqlTeste = "select DISTINCT m.Localizacao_idLocalizacao, l.Localizacao, m.DescricaoMat
                From material m, tipomaterial t, categoria c, localizacao l, situacaomat s, situacaomat_has_material sm
                where  m.Localizacao_idLocalizacao = l.idLocalizacao";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;
}

//retorna todos os materiais baixados
function getMaterialBaixados() {

$sql = "SELECT COUNT(m.Quantidade) as Quantidade,
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat,
        m.idGrupoMaterial,
        m.Localizacao_idLocalizacao,
        m.NumPatrimonio

        FROM material m, localizacao l, tipomaterial tm, categoria c,
        situacaomat sm
                WHERE  m.Localizacao_idLocalizacao = l.idLocalizacao
                and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
                and m.Categoria_idCategoria = c.idCategoria
                and m.Situacaomat_idSituacao = sm.idSituacaoMat
                and m.Situacaomat_idSituacao = 2

        GROUP by
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat,
m.idGrupoMaterial,
        m.Localizacao_idLocalizacao,
        m.NumPatrimonio";

$sqlTeste = "select DISTINCT m.Localizacao_idLocalizacao, l.Localizacao, m.DescricaoMat
                From material m, tipomaterial t, categoria c, localizacao l, situacaomat s, situacaomat_has_material sm
                where  m.Localizacao_idLocalizacao = l.idLocalizacao";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;
}

function getMaterialDeposito() {

$sql = "SELECT COUNT(m.Quantidade) as Quantidade,
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat

        FROM material m, localizacao l, tipomaterial tm, categoria c,
        situacaomat sm
                WHERE m.Localizacao_idLocalizacao = 1
                and m.Localizacao_idLocalizacao = l.idLocalizacao
                and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
                and m.Categoria_idCategoria = c.idCategoria
                and m.Situacaomat_idSituacao = sm.idSituacaoMat

        GROUP by
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;
}

function getAlteracao() {

$sql = "SELECT  date_format(a.dataAlteracao,'%d/%m/%Y') as dataAlteracao,
                m.DescricaoMat,
                a.Descricao,
                a.Siape,
                u.NomeUsuario,
                l.Localizacao,
                a.QuantidadeAlt,
                m.NumPatrimonio,
                a.memorandoSei

        FROM alteracao a, material m, localizacao l, usuarios u
        WHERE a.idMaterial = m.idMaterial
        AND   a.idLocalizacao = l.idLocalizacao
        AND   a.Siape = u.Siape";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;
}

function getAlteracaoData($datainicial,$datafinal) {

$sql = "SELECT  date_format(a.dataAlteracao,'%d/%m/%Y') as dataAlteracao,
                m.DescricaoMat,
                a.Descricao,
                a.Siape,
                u.NomeUsuario,
                l.Localizacao,
                a.QuantidadeAlt,
                m.NumPatrimonio

        FROM alteracao a, material m, localizacao l, usuarios u
        WHERE a.idMaterial = m.idMaterial
        AND (date_format(a.dataAlteracao,'%Y-%m-%d') BETWEEN '$datainicial' and '$datafinal')
        AND   a.idLocalizacao = l.idLocalizacao
        AND   a.Siape = u.Siape";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;
}

function getBaixados() {

$sql = "SELECT  date_format(bm.dataBaixa,'%d/%m/%Y') as dataBaixa,
    m.DescricaoMat,
bm.qtdBaixa,
bm.motivoBaixa,
bm.memorandoBaixa,
u.NomeUsuario,
        sm.SituacaoMat,
        m.NumPatrimonio


        FROM baixamat bm, material m, localizacao l, usuarios u, situacaomat sm
        WHERE bm.material_idMaterial = m.idGrupoMaterial
and   bm.Usuarios_idUsuario = u.idUsuario
        and   bm.situacaomat_idSituacaoMat = sm.idSituacaoMat
GROUP by
dataBaixa,
    m.DescricaoMat,
bm.qtdBaixa,
bm.motivoBaixa,
bm.memorandoBaixa,
u.NomeUsuario,
        sm.idSituacaoMat,
        m.NumPatrimonio";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;

}

function getAtivos() {

$sql = "SELECT COUNT(m.Quantidade) as Quantidade,
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat,
        m.idGrupoMaterial,
        m.Localizacao_idLocalizacao,
        m.NumPatrimonio

        FROM material m, localizacao l, tipomaterial tm, categoria c,
        situacaomat sm
                WHERE  m.Localizacao_idLocalizacao = l.idLocalizacao
                and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
                and m.Categoria_idCategoria = c.idCategoria
                and m.Situacaomat_idSituacao = sm.idSituacaoMat
                and m.Situacaomat_idSituacao = 1

        GROUP by
m.DescricaoMat,
tm.TipoMaterial,
c.Categoria,
l.Localizacao,
sm.SituacaoMat,
m.idGrupoMaterial,
        m.Localizacao_idLocalizacao,
        m.NumPatrimonio";

$sqlTeste = "select DISTINCT m.Localizacao_idLocalizacao, l.Localizacao, m.DescricaoMat
                From material m, tipomaterial t, categoria c, localizacao l, situacaomat s, situacaomat_has_material sm
                where  m.Localizacao_idLocalizacao = l.idLocalizacao";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;
}

function getTramitacao() {

$sql = "SELECT date_format(tm.DataHora,'%d/%m/%Y') as dataTramitacao,
                tm.DataHora,
           tm.MotivoTramitacao,
           m.DescricaoMat,
           u.NomeUsuario,
           u.Siape,
           tm.Origem,
           tm.Destino,
           tm.Quantidade,
           m.NumPatrimonio,
           l.Localizacao as Origem,
           l2.localizacao as Destino,
           sl.subLocalizacao

           FROM tramitacaomat tm, material m, usuarios u, localizacao l, localizacao l2, sublocalizacao sl

           WHERE tm.Material_idMaterial = m.idGrupoMaterial
           AND tm.Usuarios_idUsuario = u.idUsuario
           AND tm.Usuarios_Siape = u.Siape
           and tm.idLocalizacaoOrigem = l.idLocalizacao
           AND tm.idLocalizacaoDestino = l2.idLocalizacao
           AND m.sublocalizacao_idSubLocalizacao = sl.idSubLocalizacao
           AND tm.sublocalizacao_idSubLocalizacao = sl.idSubLocalizacao
        GROUP by
           tm.MotivoTramitacao,
           m.DescricaoMat,
           u.NomeUsuario,
           u.Siape,
           tm.Origem,
           tm.Destino,
           tm.Quantidade,
           m.NumPatrimonio,
           l.Localizacao,
           l2.localizacao,
           tm.DataHora,
           sl.subLocalizacao
        ORDER BY
                tm.dataHora desc";

$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();

return $resultado;
}

function getTramitacaoData($datainicial,$datafinal) {

    $sql = "SELECT date_format(tm.DataHora,'%d/%m/%Y') as dataTramitacao,
         tm.MotivoTramitacao,
         m.DescricaoMat,
         u.NomeUsuario,
         u.Siape,
         tm.Origem,
               tm.Destino,
         tm.Quantidade,
         m.NumPatrimonio,
               l.Localizacao as Origem,
               l2.localizacao as Destino

         FROM tramitacaomat tm, material m, usuarios u, localizacao l, localizacao l2

         WHERE tm.Material_idMaterial = m.idGrupoMaterial
         AND tm.Usuarios_idUsuario = u.idUsuario
         AND tm.Usuarios_Siape = u.Siape
               and tm.idLocalizacaoOrigem = l.idLocalizacao
               AND tm.idLocalizacaoDestino = l2.idLocalizacao
               AND (date_format(tm.DataHora,'%Y-%m-%d') BETWEEN '$datainicial' and '$datafinal')
      GROUP by
               tm.MotivoTramitacao,
         m.DescricaoMat,
         u.NomeUsuario,
         u.Siape,
         tm.Origem,
               tm.Destino,
         tm.Quantidade,
         m.NumPatrimonio,
               l.Localizacao,
               l2.localizacao,
         tm.DataHora";



    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

//retorna todas as localizações
function getLocalizacaoAll() {


    $sql = "SELECT idLocalizacao, Localizacao FROM localizacao order by Localizacao ";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

//retorna todas as localizações ATIVAS
function getLocalizacaoAtiva() {

            $sql = "SELECT idLocalizacao, Localizacao FROM localizacao where ativo = 1 order by Localizacao";

            $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
            $resultado->execute();

            return $resultado;
  }

function getLocalizacao($idLocalizacao) {


    $sql = "SELECT idLocalizacao, Localizacao
        FROM localizacao
        where idLocalizacao = $idLocalizacao";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getSubLocalizacao($idLocalizacao) {


    $sql = "SELECT idSubLocalizacao,
                               subLocalizacao,
                               localizacao_idLocalizacao
                        FROM sublocalizacao
                        WHERE localizacao_idLocalizacao = $idLocalizacao
            order by subLocalizacao";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getSubLocalizacaoAll() {


    $sql = "SELECT idSubLocalizacao,
                               subLocalizacao,
                               localizacao_idLocalizacao
                        FROM sublocalizacao";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getIndiceMaterial() {



    $sql = "";



    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }


//metódo feito por mim para verificar se um local possui subLocalização, pois
//não estava sendo possível listar os materiais dos locais sem sublocais com os
//métodos já implementados. Perguntar sobre isso pro Martins.
/*function temSublocal($idLocalizacao){
    $sql =   "SELECT idSubLocalizacao FROM sublocalizacao "
           . "WHERE localizacao_idLocalizacao = $idLocalizacao";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado->rowCount();
}*/

/*function getMaterialNoSub($idLocalizacao){
    $sql = "SELECT COUNT(m.Quantidade) as Quantidade,
                        m.DescricaoMat,
                        tm.TipoMaterial,
                        c.Categoria,
                        l.Localizacao,
                        sm.SituacaoMat,
      m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio

      FROM material m, localizacao l, tipomaterial tm, categoria c, situacaomat sm
        WHERE  m.Localizacao_idLocalizacao = l.idLocalizacao
        and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
        and m.Categoria_idCategoria = c.idCategoria
        and m.Situacaomat_idSituacao = sm.idSituacaoMat
        and m.Localizacao_idLocalizacao = $idLocalizacao

      GROUP by
                        m.DescricaoMat,
                        tm.TipoMaterial,
                        c.Categoria,
                        l.Localizacao,
                        sm.SituacaoMat,
                        m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio";
    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
}*/

function getMaterialAll($idLocalizacao) {
    $sql = "SELECT COUNT(m.Quantidade) as Quantidade,
                        m.DescricaoMat,
                        tm.TipoMaterial,
                        c.Categoria,
                        l.Localizacao,
                        sm.SituacaoMat,
      m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio,
                        sl.subLocalizacao,
                        sublocalizacao_idSubLocalizacao

      FROM material m, localizacao l, tipomaterial tm, categoria c, sublocalizacao sl, situacaomat sm
        WHERE  m.Localizacao_idLocalizacao = l.idLocalizacao
        and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
        and m.Categoria_idCategoria = c.idCategoria
        and m.Situacaomat_idSituacao = sm.idSituacaoMat
        and m.Localizacao_idLocalizacao = $idLocalizacao
                                and m.sublocalizacao_idSubLocalizacao = sl.idSubLocalizacao

      GROUP by
                        m.DescricaoMat,
                        tm.TipoMaterial,
                        c.Categoria,
                        l.Localizacao,
                        sm.SituacaoMat,
                        m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio,
                        sl.subLocalizacao,
                        sublocalizacao_idSubLocalizacao";



    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getMaterialSubLocal($idLocalizacao,$sublocalizacao) {

    $sql = "SELECT COUNT(m.Quantidade) as Quantidade,
                        m.DescricaoMat,
                        tm.TipoMaterial,
                        c.Categoria,
                        l.Localizacao,
                        sm.SituacaoMat,
      m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio,
                        sl.subLocalizacao

      FROM material m, localizacao l, tipomaterial tm, categoria c, sublocalizacao sl, situacaomat sm
        WHERE  m.Localizacao_idLocalizacao = l.idLocalizacao
        and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
        and m.Categoria_idCategoria = c.idCategoria
        and m.Situacaomat_idSituacao = sm.idSituacaoMat
        and m.Localizacao_idLocalizacao = $idLocalizacao
                                and m.sublocalizacao_idSubLocalizacao = $sublocalizacao
                                and m.sublocalizacao_idSubLocalizacao = sl.idSubLocalizacao

      GROUP by
                        m.DescricaoMat,
                        tm.TipoMaterial,
                        c.Categoria,
                        l.Localizacao,
                        sm.SituacaoMat,
                        m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio,
                        sl.subLocalizacao";



    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getMaterialDistinct() {

    $sql = "SELECT  DISTINCT(DescricaoMat) as DescricaoMat,
                                idGrupoMaterial,
                                TipoMaterial_idTipoMaterial,
                                Categoria_idCategoria,
                                NumPatrimonio
        FROM material m
                        WHERE m.Situacaomat_idSituacao = 1
                        ORDER BY DescricaoMat";



    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getMaterialCode($idGrupoMaterial) {

    $sql = "SELECT COUNT(m.Quantidade) as Quantidade,
                        m.DescricaoMat,
                        tm.TipoMaterial,
                        c.Categoria,
                        l.Localizacao,
                        sm.SituacaoMat,
      m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio

      FROM material m, localizacao l, tipomaterial tm, categoria c,
      situacaomat sm
        WHERE  m.Localizacao_idLocalizacao = l.idLocalizacao
        and m.TipoMaterial_idTipoMaterial = tm.idTipoMaterial
        and m.Categoria_idCategoria = c.idCategoria
        and m.Situacaomat_idSituacao = sm.idSituacaoMat
        and m.idGrupoMaterial = $idGrupoMaterial

      GROUP by
            m.DescricaoMat,
            tm.TipoMaterial,
            c.Categoria,
            l.Localizacao,
            sm.SituacaoMat,
            m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio";



    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getMaster($siape) {


    $sql = "SELECT master,siape FROM usuarios
                         where master = 1
                         and siape = $siape";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function getUsuarios() {


    $sql = "SELECT siape,nomeUsuario,ativo
                        FROM usuarios
                        order by idUsuario desc";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function login($siape, $senha){
    $sql = "SELECT * FROM usuarios WHERE siape = '$siape'
                                           AND senha = '$senha'";
    $resultado = self::$con->prepare($sql)  OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    return $resultado;
  }

function insereAlteracao($descricao,$idMaterial,$siape,$idLocalizacao,$quantidade,$memorandoSei){

    $sql = "INSERT INTO alteracao(Descricao,idMaterial,Siape,idLocalizacao,QuantidadeAlt,memorandoSei)
                                    VALUES('$descricao',$idMaterial,$siape,$idLocalizacao,$quantidade,$memorandoSei)";
        $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
        $resultado->execute();

        if ($resultado) {
            $mat = $this->getMaterialCode($idMaterial);
            $mat2 = $mat->fetch(PDO::FETCH_ASSOC);
            $nomeMat = $mat2['DescricaoMat'];
            $numpat = $mat2['NumPatrimonio'];

            try {
                $email_assunto = "Nova alteração de material no SCM - GPCIU";
                $mensagem = "Caro Usuário, informamos que foi cadastrada uma nova alteração no Sistem de Controle de Materiais - SCM - GPCIU";
                $mensagem .= "Acesse o Sistema no link: www.gpciu.com.br \n\n";
                $mensagem .= "Alteração: $descricao\n\n";
                $mensagem .= "Quantidade: $quantidade\n\n";
                $mensagem .= "Material: $nomeMat\n\n";
                $mensagem .= "Patrimônio: $numpat\n\n";
                $mensagem .= "Att, SCM - GPCIU.";

                //envia SEOPE
                $siapeUsuario = "1920000"; //siape SEOPE
                $email = $this->enviaEmail($siapeUsuario, $email_assunto, $mensagem);
                if ($email == 1) {
                    echo"<script language='javascript' type='text/javascript'>alert('Alteração cadastrada com sucesso! Enviado email à SECOP');</script>";
                } else {
                    echo"<script language='javascript' type='text/javascript'>alert('Alteração cadastrada com sucesso!');</script>";
                }

                return true;
            } catch (Exception $e) {
                die("Erro ao tramitar, erro " . $e->getMessage());
            }
        } else {
            return false;
        }
    }

//função para inserir novos materias
function insereMaterial($descricao,$quantidade,$patrimonio,$categoria,$localizacao,$tipomaterial,$nome_imagem,$siape,$idSubLocalizacao){

                if($patrimonio != ''){
                    $sql = "SELECT * FROM material WHERE NumPatrimonio = '$patrimonio'";
                    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
                    $resultado->execute();
                    $nResultado = $resultado->fetchColumn();

                    if($nResultado > 1){
                            return 0; // erro 0 patrimonio já cadastrado
                    }
                }
                else{
                    $sql = "SELECT * FROM material WHERE descricaoMat = '$descricao'";
                    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
                    $resultado->execute();
                    $nResultado = $resultado->fetchColumn();

                    if($nResultado > 1){
                            return 0; // erro 0 material já cadastrado
                    }
                }

    try{


                        if(empty($idSubLocalizacao)){
                            $idSubLocalizacao = 0;
                        }

                        /*O campo NumPatrimonio no BD é null por padrão e unico,
                        a inserção de uma string vazia estava impossibilitando o cadastro do material.
                        a validação a seguir foi inserida para tratar isso, não inserindo valor para NumPatrimonio
                        quando o valor inserido no formuário HTML for uma string vazia*/
                        if($patrimonio == ''){
                              $sql = "INSERT into material (categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao, Quantidade,Situacaomat_idSituacao,Usuarios_Siape, TipoMaterial_idTipoMaterial,fotoMaterial,sublocalizacao_idSubLocalizacao)
                              VALUES($categoria,'$descricao',$localizacao,1,1,$siape,$tipomaterial,'$nome_imagem','$idSubLocalizacao')";
                        }else{
                              $sql = "INSERT into material (categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao, NumPatrimonio, Quantidade,Situacaomat_idSituacao,Usuarios_Siape, TipoMaterial_idTipoMaterial,fotoMaterial,sublocalizacao_idSubLocalizacao)
                              VALUES($categoria,'$descricao',$localizacao,'$patrimonio',1,1,$siape,$tipomaterial,'$nome_imagem','$idSubLocalizacao')";
                        }


      $exec = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
      $exec->execute();
      $ultimoid = self::$con->lastInsertId();
      $sql1 = "update material set idGrupoMaterial = $ultimoid where idMaterial = $ultimoid";
      $exec = self::$con->prepare($sql1) OR trigger_error($con->error, E_USER_ERROR);
      $exec->execute();

      $quantidade--;

      for($i=0;$i<$quantidade;$i++){

        $sql2 = "INSERT into material (idGrupoMaterial, categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao, NumPatrimonio, Quantidade,Situacaomat_idSituacao,Usuarios_Siape, TipoMaterial_idTipoMaterial,fotoMaterial,sublocalizacao_idSubLocalizacao)
          VALUES('$ultimoid','$categoria','$descricao',$localizacao,'$patrimonio',1,1,$siape,$tipomaterial,'$nome_imagem','$idSublocalizacao')";

        $exec = self::$con->prepare($sql2) OR trigger_error($con->error, E_USER_ERROR);
        $exec->execute();

      }
      return true;
    }
    catch(Exception $e){
        die("erro ao cadastrar, erro ".$e->getMessage());
    }

  }

//função para inserir novos itens a um material
function insereItensMaterial($quantidade,$localizacao,$nome_imagem,$siape,$idGrupoMaterial){

//recupera a categoria do material
$sql = "select categoria_idcategoria
        from material m where m.idGrupoMaterial = $idGrupoMaterial limit 1";
$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();
$result = $resultado->fetch(PDO::FETCH_ASSOC);
$categoria = $result['categoria_idcategoria'];

//recupera o tipo do material
$sql = "select  TipoMaterial_idTipoMaterial
        from material m where m.idGrupoMaterial = $idGrupoMaterial limit 1";
$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();
$result = $resultado->fetch(PDO::FETCH_ASSOC);
$tipomaterial = $result['TipoMaterial_idTipoMaterial'];

//recupera a descrição do material
$sql = "select descricaoMat from material m where m.idGrupoMaterial = $idGrupoMaterial limit 1";
$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();
$result = $resultado->fetch(PDO::FETCH_ASSOC);
$descricao = $result['descricaoMat'];

//recupera o patrimônio do material
$sql = "select NumPatrimonio from material m where m.idGrupoMaterial = $idGrupoMaterial limit 1";
$resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();
$result = $resultado->fetch(PDO::FETCH_ASSOC);
$patrimonio = $result['NumPatrimonio'];


try{
        $sql = "INSERT into material (idGrupoMaterial,categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao, Quantidade,Situacaomat_idSituacao,Usuarios_Siape, TipoMaterial_idTipoMaterial,fotoMaterial,sublocalizacao_idSubLocalizacao)
                  VALUES($idGrupoMaterial,$categoria,'$descricao',$localizacao,1,1,$siape,$tipomaterial,'$nome_imagem',0)";

        $exec = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
        $exec->execute();

        $quantidade--;

    for($i=0;$i<$quantidade;$i++){

                $sql2 = "INSERT into material (idGrupoMaterial,categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao, Quantidade,Situacaomat_idSituacao,Usuarios_Siape, TipoMaterial_idTipoMaterial,fotoMaterial,sublocalizacao_idSubLocalizacao)
                  VALUES($idGrupoMaterial,$categoria,'$descricao',$localizacao,1,1,$siape,$tipomaterial,'$nome_imagem',0)";

                $exec = self::$con->prepare($sql2) OR trigger_error($con->error, E_USER_ERROR);
                $exec->execute();

        }
        return true;
}
catch(Exception $e){
    die("erro ao cadastrar, erro ".$e->getMessage());
}

}

//função para enviar email
function enviaEmail($siape,$email_assunto,$mensagem){

  $sql = "SELECT email,nomeUsuario
      FROM usuarios
      where siape = $siape";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();
    $master = $resultado->fetch(PDO::FETCH_ASSOC);

    //email
    $email_destinatario = $master['email'];
    $email = $master['email'];

    //nome
    $nome = $master['nomeUsuario'];

    //REMETENTE --&gt; ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
    //====================================================
    $email_remetente = "scm@gpciu.com.br"; // deve ser uma conta de email do seu dominio
    //====================================================

    //Configurações do email, ajustar conforme necessidade
    //====================================================
    //$email_destinatario = "email@querecebe"; // pode ser qualquer email que receberá as mensagens
    $email_reply = "scm@gpciu.com.br";
    //$email_assunto = "Contato formmail"; // Este será o assunto da mensagem
    //====================================================

    //Monta o Corpo da Mensagem
    //====================================================
    $email_conteudo = "Nome: $nome \n";
    $email_conteudo .= "Email: $email \n";
    $email_conteudo .= "Mensagem: $mensagem \n";
    //====================================================

    //Seta os Headers (Alterar somente caso necessario)
    //====================================================
    $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Subject: $email_assunto","Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
    //====================================================

    //Enviando o email
    //====================================================
    if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
       // echo "</b&gt;E-Mail enviado com sucesso!</b&gt;";
      return 1;
        }
      else{
        //echo "</b&gt;Falha no envio do E-Mail!</b&gt;";
        return 0;
        }
    //====================================================

  }

//utilizada para ativar usuários (ativausuario.php)
function ativaUsuario($ativar,$siapeUsuario){
     $sql = "UPDATE usuarios SET ativo = $ativar
                            WHERE siape = $siapeUsuario";

                try{

                    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
                    $resultado->execute();

    return true;
    }
    catch(Exception $e){
        die("erro ao cadastrar, erro ".$e->getMessage());
                    return 0;
    }

  }

//utilizada para recuperar senha
function recuperaSenha($cpf,$email,$siape,$senha){

    $sql = "select * from usuarios u where u.Siape = '$siape'
                                     AND   u.CPF   = '$cpf'
                                     AND   u.email = '$email'
                                     AND   u.ativo = 1";

    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();
    $nResultado = $resultado->fetchColumn();

    if($nResultado > 0){
      $senhaMD5 = MD5($senha);

       $query2 = "UPDATE usuarios set Senha = '$senhaMD5'
                  WHERE Siape = '$siape' AND CPF   = '$cpf'";
    }
    else{
      return false;//usuário não existe
    }

    try{
        $resultado = self::$con->prepare($query2) OR trigger_error($con->error, E_USER_ERROR);
        $resultado->execute();
        return true;
    }
    catch(Exception $e){
       die("erro ao cadastrar, erro ".$e->getMessage());
       return false;
    }

}

//utilizada para ativar materiais (ativamaterial.php)
function ativaMaterial($idGrupoMat,$idLocal,$alteracao,$quantidade,$memorando,$idUsuario,$siape){

    $idBaixados = "select idMaterial  from material
                    where idGrupoMaterial = $idGrupoMat
                    and localizacao_idlocalizacao = $idLocal
                    and Situacaomat_idSituacao = 2
                    order BY idMaterial  desc limit $quantidade";

    $resultado = self::$con->prepare($idBaixados) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    $baixados;
    $i = 0;
    while($t = $resultado->fetch( PDO::FETCH_ASSOC )){
    $baixados .= $t['idMaterial'] . ",";
    }
    $baixados = substr($baixados, 0, -1);

    $query = "INSERT INTO baixamat
                        (motivoBaixa,
                         memorandoBaixa,
                         Usuarios_idUsuario,
                         Usuarios_Siape,
                         material_idMaterial,
                         idBaixados,
                         qtdBaixa,
                         situacaomat_idSituacaoMat)
                         VALUES ('$alteracao','$memorando',$idUsuario,$siape,$idGrupoMat,'$baixados',$quantidade,1)";

    $query2 = "UPDATE material set Situacaomat_idSituacao = 1
              where idMaterial in(
                  SELECT * from (
                                    select idMaterial  from material
                                    where idGrupoMaterial = $idGrupoMat
                                    and localizacao_idlocalizacao = $idLocal
                                    and Situacaomat_idSituacao = 2
                                    order BY idMaterial  desc limit $quantidade
                               )
                            as t);";

    $queryQtd = "SELECT COUNT(Quantidade) as Quantidade FROM material
                where idGrupoMaterial = $idGrupoMat
                                                and localizacao_idlocalizacao = $idLocal
                                                and Situacaomat_idSituacao = 2
                                                order BY idMaterial  desc limit $quantidade";
    $resultado = self::$con->prepare($queryQtd) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();
    $mat2 = $resultado->fetch(PDO::FETCH_ASSOC);
    $verifica = $mat2['Quantidade'];

    if (($quantidade > $verifica) || ($quantidade <= 0)) {
        return FALSE; //quantidade digitada é maoir do que a quantidade disponível
    }

    try {
    $resultado = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();
    $resultado2 = self::$con->prepare($query2) OR trigger_error($con->error, E_USER_ERROR);
    $resultado2->execute();

      return true;
    }
    catch (Exception $e){
      return false;
    }
}

//utilizada para ativar materiais (ativamaterial.php)
function baixaMaterial($idGrupoMat,$idLocal,$alteracao,$quantidade,$memorando,$idUsuario,$siape){

    $idAtivados = "select idMaterial  from material
                    where idGrupoMaterial = $idGrupoMat
                    and localizacao_idlocalizacao = $idLocal
                    and Situacaomat_idSituacao = 1
                    order BY idMaterial  desc limit $quantidade";

    $resultado = self::$con->prepare($idAtivados) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();

    $baixados;
    $i = 0;
    while($t = $resultado->fetch( PDO::FETCH_ASSOC )){
    $baixados .= $t['idMaterial'] . ",";
    }
    $baixados = substr($baixados, 0, -1);

    $query = "INSERT INTO baixamat
                        (motivoBaixa,
                         memorandoBaixa,
                         Usuarios_idUsuario,
                         Usuarios_Siape,
                         material_idMaterial,
                         idBaixados,
                         qtdBaixa,
                         situacaomat_idSituacaoMat)
                         VALUES ('$alteracao','$memorando',$idUsuario,$siape,$idGrupoMat,'$baixados',$quantidade,2)";

    $query2 = "UPDATE material set Situacaomat_idSituacao = 2
              where idMaterial in(
                  SELECT * from (
                                    select idMaterial  from material
                                    where idGrupoMaterial = $idGrupoMat
                                    and localizacao_idlocalizacao = $idLocal
                                    and Situacaomat_idSituacao = 1
                                    order BY idMaterial  desc limit $quantidade
                               )
                            as t);";

    $queryQtd = "SELECT COUNT(Quantidade) as Quantidade FROM material
                where idGrupoMaterial = $idGrupoMat
                                                and localizacao_idlocalizacao = $idLocal
                                                and Situacaomat_idSituacao = 1
                                                order BY idMaterial  desc limit $quantidade";
    $resultado = self::$con->prepare($queryQtd) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();
    $mat2 = $resultado->fetch(PDO::FETCH_ASSOC);
    $verifica = $mat2['Quantidade'];

    if (($quantidade > $verifica) || ($quantidade <= 0)) {
        return FALSE; //quantidade digitada é maoir do que a quantidade disponível
    }

    try {
            $resultado = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
            $resultado->execute();
            $resultado2 = self::$con->prepare($query2) OR trigger_error($con->error, E_USER_ERROR);
            $resultado2->execute();

      return true;
    }
    catch (Exception $e){
      return false;
    }
}

//manter as localizações
function manterLocalizacao($novalocalizacao,$idLocalizacao,$ativo){

            //verifica se já existe essa localização
            $sql = "SELECT * FROM localizacao WHERE Localizacao = '$novalocalizacao' and idLocalizacao != $idLocalizacao";
            $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
            $resultado->execute();
            $nResultado = $resultado->fetchColumn();

            if($nResultado){
                return 0; // erro 0 localização já cadastrada
            }
            else{
                $query = "UPDATE localizacao
                               SET Localizacao = '$novalocalizacao',
                                   ativo = $ativo
                               WHERE idLocalizacao = $idLocalizacao";
                try{

                    $resultado = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
                    $resultado->execute();
                    return true;//localização alterada com sucesso!
    }
    catch(Exception $e){
        die("erro ao criar a localização, erro ".$e->getMessage());
                    return FALSE;//erro ao alterar localização

    }
            }
}

//manter os materiais
function manterMaterial($descricao,$patrimonio,$categoria,$tipomaterial,$idGrupoMaterial,$nome_imagem,$siape){

    //verifica se já existe esse material
    $sql = "SELECT * FROM material
            WHERE idGrupoMaterial != $idGrupoMaterial
            and idGrupoMaterial  in(
            SELECT idGrupoMaterial
            FROM material
            where NumPatrimonio = $patrimonio
            or descricaoMat = '$descricao')";
    $resultado = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
    $resultado->execute();
    $nResultado = $resultado->fetchColumn();

    if($nResultado){
        return 0; // erro 0 material já cadastrada
    }
    else{
            $query = "UPDATE material
                      SET DescricaoMat ='$descricao',
                          NumPatrimonio ='$patrimonio',
                          TipoMaterial_idTipoMaterial =$tipomaterial,
                          Categoria_idCategoria = $categoria,
                          FotoMaterial = '" . $nome_imagem . "',
                          Usuarios_Siape = $siape
                    WHERE idGrupoMaterial = $idGrupoMaterial";
        try{

            $resultado = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
            $resultado->execute();
            return true;//localização alterada com sucesso!
        }
        catch(Exception $e){
            die("erro ao criar a localização, erro ".$e->getMessage());
            return FALSE;//erro ao alterar localização

        }
    }
}

//tramita os materias
function tramitaMaterial($origem,$destino,$quantidade,$idmaterial,$motivo,$sublocalizacao,$siape,$idUsuario){

            //separa os valores ID Sub Localização e ID GRUPO MATERIAL
            $posicao = strpos($idmaterial, '/');

            //print_r ($id.": ");
            // ID Sub Localização
            $idSubLoc = substr($idmaterial, $posicao + 1, 4);

            // ID GRUPO MATERIAL
            $idMat = substr($idmaterial, 0, $posicao);

            $query = "SELECT COUNT(Quantidade) FROM material WHERE idGrupoMaterial = $idMat
                and localizacao_idlocalizacao = $origem
                and sublocalizacao_idSubLocalizacao = $idSubLoc";
            $resultado = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
            $resultado->execute();
            $nResultado = $resultado->fetchColumn();

            if (($quantidade > $nResultado) || ($quantidade <= 0)) {
                return false;
            }
            else {

                $idTramitados = "select idMaterial  from material
                            where idGrupoMaterial = $idMat
                            and localizacao_idlocalizacao = $origem
                            and sublocalizacao_idSubLocalizacao = $idSubLoc
                         order BY idMaterial  desc limit $quantidade";

                $resultado = self::$con->prepare($idTramitados) OR trigger_error($con->error, E_USER_ERROR);
                $resultado->execute();
                $tramitados;
                $i = 0;

                while($t = $resultado->fetch( PDO::FETCH_ASSOC )){
                    $tramitados .= $t['idMaterial'] . ",";
                }
                $tramitados = substr($tramitados, 0, -1);

                $query = "UPDATE material set Localizacao_idLocalizacao = '$destino',
                                       sublocalizacao_idSubLocalizacao = '$sublocalizacao'
                                 where idMaterial in(
                                SELECT * from (
                                                select idMaterial  from material
                                                        where idGrupoMaterial = $idMat
                                                        and localizacao_idlocalizacao = $origem
                                                        and sublocalizacao_idSubLocalizacao = $idSubLoc
                                                        order BY idMaterial  desc limit $quantidade
                                               )
                                as t)";

                $query2 = "INSERT INTO tramitacaomat
                             (MotivoTramitacao,
                             Material_idMaterial,
                             Usuarios_idUsuario,
                             Usuarios_Siape,
                             idLocalizacaoOrigem,
                             idLocalizacaoDestino,
                             Quantidade,
                             idMaterialTramitados,
                             sublocalizacao_idSubLocalizacao)
                             VALUES ('$motivo',$idMat,$idUsuario,$siape,$origem,$destino,$quantidade,'$tramitados',$sublocalizacao)";

                try {
                        //tramita o material
                        $tramitar = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
                        $tramitar->execute();

                        //faz um insert na tabela tramitacaomat
                        $tramitacaomat = self::$con->prepare($query2) OR trigger_error($con->error, E_USER_ERROR);
                        $tramitacaomat->execute();

                        return TRUE;
                }
                catch (Exception $e){
                        return false;
                }
            }
        }

//Verifica se uma sublocalização é portátil, tramitável (bolsa, caixa, case, etc...)
function eTramitavel($idSublocalizacao){
    $texto = "SELECT tramitavel FROM sublocalizacao WHERE "
            . "idSublocalizacao = $idSublocalizacao";

    $consulta = self::$con->prepare($texto) OR trigger_error($con->error, E_USER_ERROR);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    //var_dump($resultado);
    return $resultado['tramitavel'];

}

//A tramitação coletiva, quando aplicada a bolsa, case, caixa, tramita a sublocalização por meio dessa função
function tramitaSublocalizacao($destino,$sublocalizacaoOrigem){
    //tramita a sublocalização mudando a chave estrangeira para corresponder a nova localização
    //a verificação se é tramitável não é feita na função
    $sql = "UPDATE sublocalizacao SET Localizacao_idLocalizacao = $destino WHERE idSubLocalizacao = $sublocalizacaoOrigem";

    try{
        $consulta = self::$con->prepare($sql) OR trigger_error($con->error, E_USER_ERROR);
        $consulta->execute();
        return true;
    }catch(Exception $e){
        return false;
    }
}

//tramitaca os materias coletivamente
function tramitacaoColetiva($origem,$destino,$motivo,$sublocalizacaoOrigem,$sublocalizacaoDestino,$siape,$idUsuario){

    //Consulta os diferentes IDs de grupo de material de uma dada sublocalização de um dado sublocal
    $consulta = "SELECT DISTINCT(idGrupoMaterial)
                         from material
                         where localizacao_idlocalizacao = $origem
                         and sublocalizacao_idSubLocalizacao = $sublocalizacaoOrigem";
    $tramitacao = self::$con->prepare($consulta) OR trigger_error($con->error, E_USER_ERROR);
    $tramitacao->execute();

    //percorre todos os materias
    WHILE($materias = $tramitacao->fetch(PDO::FETCH_ASSOC)):
        $idGrupoMaterial = $materias['idGrupoMaterial'];

        //conta quantos materias de cada grupo (idGrupoMaterial) existem em uma dada sublocalização
        $Qtd = "SELECT COUNT(Quantidade)
                    from material
                    where localizacao_idlocalizacao = $origem
                    and sublocalizacao_idSubLocalizacao = $sublocalizacaoOrigem
                    and idGrupoMaterial = $idGrupoMaterial";
        $QtdMat = self::$con->prepare($Qtd) OR trigger_error($con->error, E_USER_ERROR);
        $QtdMat->execute();
        $quantidade = $QtdMat->fetchColumn();

        $idTramitados = "SELECT idMaterial  FROM material
                            WHERE idGrupoMaterial = $idGrupoMaterial
                            and localizacao_idlocalizacao = $origem
                            and sublocalizacao_idSubLocalizacao = $sublocalizacaoOrigem
                            order BY idMaterial  desc limit $quantidade";

        $resultado = self::$con->prepare($idTramitados) OR trigger_error($con->error, E_USER_ERROR);
        $resultado->execute();
        $tramitados = "";

        while($t = $resultado->fetch( PDO::FETCH_ASSOC )){
                    $tramitados .= $t['idMaterial'] . ",";
        }

        $tramitados = substr($tramitados, 0, -1);

        /*Muda a localizacao (Localizacao_idLocalizacao)e a sublocalizacao (Sublocalizacao_idSublocalizacao)
        dos materiais pertencentes a um dado grupo (idGrupoMaterial) de uma dada localizacao e sublocalizacao.
        "Tramita" os materiais*/
        $query = "UPDATE material set Localizacao_idLocalizacao = '$destino',
                    sublocalizacao_idSubLocalizacao = '$sublocalizacaoDestino'
                    where localizacao_idlocalizacao = $origem
                    and sublocalizacao_idSubLocalizacao = $sublocalizacaoOrigem
                    and idGrupoMaterial = $idGrupoMaterial";

        //alimenta os registros quanto a tramitações na tabela tramitacaomat
        $query2 = "INSERT INTO tramitacaomat
                                 (MotivoTramitacao,
                                 Material_idMaterial,
                                 Usuarios_idUsuario,
                                 Usuarios_Siape,
                                 idLocalizacaoOrigem,
                                 idLocalizacaoDestino,
                                 Quantidade,
                                 idMaterialTramitados,
                                 sublocalizacao_idSubLocalizacao)
                                 VALUES ('$motivo',$idGrupoMaterial,$idUsuario,$siape,$origem,$destino,$quantidade,'$tramitados',$sublocalizacaoDestino)";

        try {
            //tramita o material
            $tramitar = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
            $tramitar->execute();

            //faz um insert na tabela tramitacaomat
            $tramitacaomat = self::$con->prepare($query2) OR trigger_error($con->error, E_USER_ERROR);
            $tramitacaomat->execute();

            $mensagem = true;
        }catch (Exception $e){
            $mensagem = false;
        }

    endwhile;

    return $mensagem;
}

//função para inserir novas localizações
function insereLocalizacao($localizacao){

            $verifica = "SELECT * FROM localizacao WHERE Localizacao = '$localizacao'";
            $resultado = self::$con->prepare($verifica) OR trigger_error($con->error, E_USER_ERROR);
            $resultado->execute();
            $nResultado = $resultado->fetchColumn();

         if($nResultado >= 1){
             return false; //localização já existe.
          }
          else{
             $query = "INSERT INTO localizacao (Localizacao) VALUES ('$localizacao')";
          }

          try{
             $exec = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
             $exec->execute();

             return true;
          }
          catch (Exception $e){
            return FALSE;
        }
}

//função para inserir novas localizações
function insereSubLocalizacao($idLocalizacao,$sublocalizacao, $tramitavel){

$verifica = "SELECT * FROM sublocalizacao
            WHERE sublocalizacao = '$sublocalizacao'
            and localizacao_idLocalizacao = '$idLocalizacao'";
$resultado = self::$con->prepare($verifica) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();
$nResultado = $resultado->fetchColumn();

if($nResultado > 0){
 return false; //sub localização já existe.
}
else{
 $query = "INSERT INTO sublocalizacao
                       (subLocalizacao,
                       localizacao_idLocalizacao,tramitavel)
            VALUES ('$sublocalizacao','$idLocalizacao',$tramitavel)";
}

    try{
     $exec = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
     $exec->execute();

     return true;
    }
    catch (Exception $e){
     return FALSE;
    }
}


//função para inserir usuários
function insereUsuario($nome,$cpf,$email,$siape,$senha,$senha2){

$verifica = "SELECT * FROM usuarios WHERE siape = '$siape'";
$resultado = self::$con->prepare($verifica) OR trigger_error($con->error, E_USER_ERROR);
$resultado->execute();
$nResultado = $resultado->fetchColumn();

if($nResultado >= 1){
 return false; //usuário já existe.
}
if($senha != $senha2){
   return false; //senhas não conferem.
}
else{
 $query = "insert into usuarios (CPF, email, NomeUsuario, Permissao_idPermissao, Senha, Siape)
            VALUES('$cpf','$email','$nome',2,md5('$senha'),'$siape')";
}
    try{
            $exec = self::$con->prepare($query) OR trigger_error($con->error, E_USER_ERROR);
            $exec->execute();

         return true;//usuário cadastrado com sucesso
    }
    catch (Exception $e){
         return FALSE;//falha no cadastro
    }
}

//retorna a ala de serviço do dia padrão (yyyy/mm/dd)
function alaServico($data) {
        // Usa a função criada e pega o timestamp das duas datas:

        $partes = explode('/', '18/06/2014');
        $time_inicial = mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
        //$time_inicial = geraTimestamp('19/06/2014');

        $partes1 = explode('/', $data);
        $time_final = mktime(0, 0, 0, $partes1[1], $partes1[0], $partes1[2]);
        //$time_final = geraTimestamp($data);
        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
        // Calcula a diferença de dias
        $dias = (int) floor($diferenca / (60 * 60 * 24)); // 225 dias
        switch ($dias % 4) {
            case 0:
                $alas['ala24h'] = "A";
                break;
            case 1:
                $alas['ala24h'] = "B";
                break;
            case 2:
                $alas['ala24h'] = "C";
                break;
            default:
                $alas['ala24h'] = "D";
                break;
        }
        switch ($dias % 3) {
            case 0:
                $alas['mr'] = "MR2";
                break;
            case 1:
                $alas['mr'] = "MR3";
                break;
            default:
                $alas['mr'] = "MR1";
                break;
        }
        switch ($dias % 5) {
            case 0:
                $alas['ala12d'] = "G";
                $alas['ala12n'] = "F";
                $alas['ma'] = "M1";
                $alas['mb'] = "M5";
                break;
            case 1:
                $alas['ala12d'] = "H";
                $alas['ala12n'] = "G";
                $alas['ma'] = "M2";
                $alas['mb'] = "M1";
                break;
            case 2:
                $alas['ala12d'] = "I";
                $alas['ala12n'] = "H";
                $alas['ma'] = "M3";
                $alas['mb'] = "M2";
                break;
            case 3:
                $alas['ala12d'] = "E";
                $alas['ala12n'] = "I";
                $alas['ma'] = "M4";
                $alas['mb'] = "M3";
                break;
            default:
                $alas['ala12d'] = "F";
                $alas['ala12n'] = "E";
                $alas['ma'] = "M5";
                $alas['mb'] = "M4";
                break;
        }
        return $alas;
    }

}
?>
