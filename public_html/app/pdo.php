<?php
class connectDB{

protected static $con;


function conectar(){

    $config = require __DIR__ . '/config.php';
    $db = $config['db'];

    try{
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $db['host'],
            $db['name'],
            $db['charset']
        );
        $opcoes = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        self::$con = new PDO($dsn, $db['user'], $db['pass'], $opcoes);
    }catch(PDOException $e){
        error_log('SCM DB connect error: ' . $e->getMessage());
        http_response_code(500);
        die('Falha na conexão ao banco de dados. Contate o administrador.');
    }
}

/** Exposição do PDO bruto para helpers que precisam de prepared statements. */
public function pdo(): PDO
{
    return self::$con;
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
        AND (date_format(a.dataAlteracao,'%Y-%m-%d') BETWEEN ? AND ?)
        AND   a.idLocalizacao = l.idLocalizacao
        AND   a.Siape = u.Siape";

$resultado = self::$con->prepare($sql);
$resultado->execute([$datainicial, $datafinal]);

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
               AND (date_format(tm.DataHora,'%Y-%m-%d') BETWEEN ? AND ?)
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



    $resultado = self::$con->prepare($sql);
    $resultado->execute([$datainicial, $datafinal]);

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
        where idLocalizacao = ?";

    $resultado = self::$con->prepare($sql);
    $resultado->execute([$idLocalizacao]);

    return $resultado;
  }

function getSubLocalizacao($idLocalizacao) {


    $sql = "SELECT idSubLocalizacao,
                               subLocalizacao,
                               localizacao_idLocalizacao
                        FROM sublocalizacao
                        WHERE localizacao_idLocalizacao = ?
            order by subLocalizacao";

    $resultado = self::$con->prepare($sql);
    $resultado->execute([$idLocalizacao]);

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
        and m.Localizacao_idLocalizacao = ?
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



    $resultado = self::$con->prepare($sql);
    $resultado->execute([$idLocalizacao]);

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
        and m.Localizacao_idLocalizacao = ?
                                and m.sublocalizacao_idSubLocalizacao = ?
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



    $resultado = self::$con->prepare($sql);
    $resultado->execute([$idLocalizacao, $sublocalizacao]);

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
        and m.idGrupoMaterial = ?

      GROUP by
            m.DescricaoMat,
            tm.TipoMaterial,
            c.Categoria,
            l.Localizacao,
            sm.SituacaoMat,
            m.idGrupoMaterial,
      m.Localizacao_idLocalizacao,
      m.NumPatrimonio";



    $resultado = self::$con->prepare($sql);
    $resultado->execute([$idGrupoMaterial]);

    return $resultado;
  }

function getMaster($siape) {


    $sql = "SELECT master,siape FROM usuarios
                         where master = 1
                         and siape = ?";

    $resultado = self::$con->prepare($sql);
    $resultado->execute([$siape]);

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

/**
 * Autentica o usuário pelo SIAPE e senha em texto claro.
 * Suporta hashes legados em MD5: ao autenticar com sucesso, re-hash automaticamente
 * para password_hash(BCRYPT). Retorna o array do usuário ou null.
 */
function login($siape, $senha){
    $sql = "SELECT idUsuario, NomeUsuario, Permissao_idPermissao, Siape, Senha, ativo
            FROM usuarios
            WHERE siape = ?
            LIMIT 1";
    $stmt = self::$con->prepare($sql);
    $stmt->execute([$siape]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return null;
    }

    $hashArmazenado = (string) $user['Senha'];
    $autenticado    = false;

    // Hash moderno (password_hash)
    if (password_verify($senha, $hashArmazenado)) {
        $autenticado = true;
        if (password_needs_rehash($hashArmazenado, PASSWORD_BCRYPT)) {
            $this->atualizaSenhaHash($user['Siape'], password_hash($senha, PASSWORD_BCRYPT));
        }
    }
    // Fallback para usuários antigos com hash MD5 (32 hex chars)
    elseif (strlen($hashArmazenado) === 32 && ctype_xdigit($hashArmazenado)
            && hash_equals($hashArmazenado, md5($senha))) {
        $autenticado = true;
        // Migra para bcrypt no primeiro login bem-sucedido
        $this->atualizaSenhaHash($user['Siape'], password_hash($senha, PASSWORD_BCRYPT));
    }

    return $autenticado ? $user : null;
}

private function atualizaSenhaHash($siape, $novoHash){
    $stmt = self::$con->prepare("UPDATE usuarios SET Senha = ? WHERE Siape = ?");
    $stmt->execute([$novoHash, $siape]);
}

function insereAlteracao($descricao,$idMaterial,$siape,$idLocalizacao,$quantidade,$memorandoSei){

    $sql = "INSERT INTO alteracao(Descricao,idMaterial,Siape,idLocalizacao,QuantidadeAlt,memorandoSei)
                                    VALUES(?, ?, ?, ?, ?, ?)";
        $resultado = self::$con->prepare($sql);
        $resultado->execute([$descricao, $idMaterial, $siape, $idLocalizacao, $quantidade, $memorandoSei]);

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

    if ($patrimonio != '') {
        $stmt = self::$con->prepare("SELECT COUNT(*) FROM material WHERE NumPatrimonio = ?");
        $stmt->execute([$patrimonio]);
        if ((int) $stmt->fetchColumn() > 1) {
            return 0; // patrimonio já cadastrado
        }
    } else {
        $stmt = self::$con->prepare("SELECT COUNT(*) FROM material WHERE descricaoMat = ?");
        $stmt->execute([$descricao]);
        if ((int) $stmt->fetchColumn() > 1) {
            return 0; // material já cadastrado
        }
    }

    try {
        if (empty($idSubLocalizacao)) {
            $idSubLocalizacao = 0;
        }

        /* NumPatrimonio é NULL por padrão e único; string vazia impede o cadastro.
           Para patrimônio vazio, omitimos a coluna. */
        if ($patrimonio == '') {
            $sql = "INSERT INTO material
                        (categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao,
                         Quantidade, Situacaomat_idSituacao, Usuarios_Siape,
                         TipoMaterial_idTipoMaterial, fotoMaterial, sublocalizacao_idSubLocalizacao)
                    VALUES (?, ?, ?, 1, 1, ?, ?, ?, ?)";
            $params = [$categoria, $descricao, $localizacao, $siape, $tipomaterial, $nome_imagem, $idSubLocalizacao];
        } else {
            $sql = "INSERT INTO material
                        (categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao,
                         NumPatrimonio, Quantidade, Situacaomat_idSituacao, Usuarios_Siape,
                         TipoMaterial_idTipoMaterial, fotoMaterial, sublocalizacao_idSubLocalizacao)
                    VALUES (?, ?, ?, ?, 1, 1, ?, ?, ?, ?)";
            $params = [$categoria, $descricao, $localizacao, $patrimonio, $siape, $tipomaterial, $nome_imagem, $idSubLocalizacao];
        }

        $exec = self::$con->prepare($sql);
        $exec->execute($params);
        $ultimoid = self::$con->lastInsertId();

        $upd = self::$con->prepare("UPDATE material SET idGrupoMaterial = ? WHERE idMaterial = ?");
        $upd->execute([$ultimoid, $ultimoid]);

        $quantidade--;

        $insertClone = self::$con->prepare(
            "INSERT INTO material
                (idGrupoMaterial, categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao,
                 NumPatrimonio, Quantidade, Situacaomat_idSituacao, Usuarios_Siape,
                 TipoMaterial_idTipoMaterial, fotoMaterial, sublocalizacao_idSubLocalizacao)
             VALUES (?, ?, ?, ?, ?, 1, 1, ?, ?, ?, ?)"
        );
        for ($i = 0; $i < $quantidade; $i++) {
            $insertClone->execute([
                $ultimoid, $categoria, $descricao, $localizacao,
                ($patrimonio == '' ? null : $patrimonio),
                $siape, $tipomaterial, $nome_imagem, $idSubLocalizacao,
            ]);
        }
        return true;
    } catch (PDOException $e) {
        error_log('insereMaterial falhou: ' . $e->getMessage());
        return false;
    }
}

//função para inserir novos itens a um material
function insereItensMaterial($quantidade,$localizacao,$nome_imagem,$siape,$idGrupoMaterial){

    $stmt = self::$con->prepare(
        "SELECT categoria_idcategoria, TipoMaterial_idTipoMaterial, descricaoMat, NumPatrimonio
         FROM material
         WHERE idGrupoMaterial = ?
         LIMIT 1"
    );
    $stmt->execute([$idGrupoMaterial]);
    $mat = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$mat) {
        return false;
    }
    $categoria    = $mat['categoria_idcategoria'];
    $tipomaterial = $mat['TipoMaterial_idTipoMaterial'];
    $descricao    = $mat['descricaoMat'];

    try {
        $insert = self::$con->prepare(
            "INSERT INTO material
                (idGrupoMaterial, categoria_idcategoria, descricaoMat, Localizacao_idLocalizacao,
                 Quantidade, Situacaomat_idSituacao, Usuarios_Siape,
                 TipoMaterial_idTipoMaterial, fotoMaterial, sublocalizacao_idSubLocalizacao)
             VALUES (?, ?, ?, ?, 1, 1, ?, ?, ?, 0)"
        );

        for ($i = 0; $i < $quantidade; $i++) {
            $insert->execute([
                $idGrupoMaterial, $categoria, $descricao, $localizacao,
                $siape, $tipomaterial, $nome_imagem,
            ]);
        }
        return true;
    } catch (PDOException $e) {
        error_log('insereItensMaterial falhou: ' . $e->getMessage());
        return false;
    }
}

//função para enviar email
function enviaEmail($siape,$email_assunto,$mensagem){

  $sql = "SELECT email,nomeUsuario
      FROM usuarios
      where siape = ?";

    $resultado = self::$con->prepare($sql);
    $resultado->execute([$siape]);
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
    try {
        $stmt = self::$con->prepare("UPDATE usuarios SET ativo = ? WHERE siape = ?");
        $stmt->execute([$ativar, $siapeUsuario]);
        return true;
    } catch (PDOException $e) {
        error_log('ativaUsuario falhou: ' . $e->getMessage());
        return 0;
    }
}

//utilizada para recuperar senha
function recuperaSenha($cpf,$email,$siape,$senha){

    $stmt = self::$con->prepare(
        "SELECT COUNT(*) FROM usuarios
         WHERE Siape = ? AND CPF = ? AND email = ? AND ativo = 1"
    );
    $stmt->execute([$siape, $cpf, $email]);

    if ((int) $stmt->fetchColumn() === 0) {
        return false; // usuário não existe ou inativo
    }

    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    try {
        $upd = self::$con->prepare(
            "UPDATE usuarios SET Senha = ? WHERE Siape = ? AND CPF = ?"
        );
        $upd->execute([$senhaHash, $siape, $cpf]);
        return true;
    } catch (PDOException $e) {
        error_log('recuperaSenha falhou: ' . $e->getMessage());
        return false;
    }
}

//utilizada para ativar materiais (ativamaterial.php)
function ativaMaterial($idGrupoMat,$idLocal,$alteracao,$quantidade,$memorando,$idUsuario,$siape){

    // Force numeric for values used in LIMIT (não bindable em prepared statements)
    $idGrupoMat = (int) $idGrupoMat;
    $idLocal    = (int) $idLocal;
    $quantidade = (int) $quantidade;

    if ($quantidade <= 0) {
        return false;
    }

    $stmt = self::$con->prepare(
        "SELECT idMaterial FROM material
         WHERE idGrupoMaterial = ? AND localizacao_idlocalizacao = ? AND Situacaomat_idSituacao = 2
         ORDER BY idMaterial DESC LIMIT $quantidade"
    );
    $stmt->execute([$idGrupoMat, $idLocal]);

    $ids = [];
    while ($t = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ids[] = (int) $t['idMaterial'];
    }
    $baixados = implode(',', $ids);

    // Verifica se há material suficiente disponível
    $q = self::$con->prepare(
        "SELECT COUNT(Quantidade) AS Quantidade FROM material
         WHERE idGrupoMaterial = ? AND localizacao_idlocalizacao = ? AND Situacaomat_idSituacao = 2"
    );
    $q->execute([$idGrupoMat, $idLocal]);
    $verifica = (int) ($q->fetch(PDO::FETCH_ASSOC)['Quantidade'] ?? 0);

    if ($quantidade > $verifica) {
        return false;
    }

    try {
        self::$con->beginTransaction();

        $ins = self::$con->prepare(
            "INSERT INTO baixamat
                (motivoBaixa, memorandoBaixa, Usuarios_idUsuario, Usuarios_Siape,
                 material_idMaterial, idBaixados, qtdBaixa, situacaomat_idSituacaoMat)
             VALUES (?, ?, ?, ?, ?, ?, ?, 1)"
        );
        $ins->execute([$alteracao, $memorando, $idUsuario, $siape, $idGrupoMat, $baixados, $quantidade]);

        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $upd = self::$con->prepare(
                "UPDATE material SET Situacaomat_idSituacao = 1 WHERE idMaterial IN ($placeholders)"
            );
            $upd->execute($ids);
        }

        self::$con->commit();
        return true;
    } catch (PDOException $e) {
        if (self::$con->inTransaction()) {
            self::$con->rollBack();
        }
        error_log('ativaMaterial falhou: ' . $e->getMessage());
        return false;
    }
}

//utilizada para dar baixa em materiais (baixamaterial.php)
function baixaMaterial($idGrupoMat,$idLocal,$alteracao,$quantidade,$memorando,$idUsuario,$siape){

    $idGrupoMat = (int) $idGrupoMat;
    $idLocal    = (int) $idLocal;
    $quantidade = (int) $quantidade;

    if ($quantidade <= 0) {
        return false;
    }

    $stmt = self::$con->prepare(
        "SELECT idMaterial FROM material
         WHERE idGrupoMaterial = ? AND localizacao_idlocalizacao = ? AND Situacaomat_idSituacao = 1
         ORDER BY idMaterial DESC LIMIT $quantidade"
    );
    $stmt->execute([$idGrupoMat, $idLocal]);

    $ids = [];
    while ($t = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ids[] = (int) $t['idMaterial'];
    }
    $baixados = implode(',', $ids);

    $q = self::$con->prepare(
        "SELECT COUNT(Quantidade) AS Quantidade FROM material
         WHERE idGrupoMaterial = ? AND localizacao_idlocalizacao = ? AND Situacaomat_idSituacao = 1"
    );
    $q->execute([$idGrupoMat, $idLocal]);
    $verifica = (int) ($q->fetch(PDO::FETCH_ASSOC)['Quantidade'] ?? 0);

    if ($quantidade > $verifica) {
        return false;
    }

    try {
        self::$con->beginTransaction();

        $ins = self::$con->prepare(
            "INSERT INTO baixamat
                (motivoBaixa, memorandoBaixa, Usuarios_idUsuario, Usuarios_Siape,
                 material_idMaterial, idBaixados, qtdBaixa, situacaomat_idSituacaoMat)
             VALUES (?, ?, ?, ?, ?, ?, ?, 2)"
        );
        $ins->execute([$alteracao, $memorando, $idUsuario, $siape, $idGrupoMat, $baixados, $quantidade]);

        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $upd = self::$con->prepare(
                "UPDATE material SET Situacaomat_idSituacao = 2 WHERE idMaterial IN ($placeholders)"
            );
            $upd->execute($ids);
        }

        self::$con->commit();
        return true;
    } catch (PDOException $e) {
        if (self::$con->inTransaction()) {
            self::$con->rollBack();
        }
        error_log('baixaMaterial falhou: ' . $e->getMessage());
        return false;
    }
}

//manter as localizações
function manterLocalizacao($novalocalizacao,$idLocalizacao,$ativo){

    $stmt = self::$con->prepare(
        "SELECT COUNT(*) FROM localizacao WHERE Localizacao = ? AND idLocalizacao != ?"
    );
    $stmt->execute([$novalocalizacao, $idLocalizacao]);
    if ((int) $stmt->fetchColumn() > 0) {
        return 0; // localização já cadastrada
    }

    try {
        $upd = self::$con->prepare(
            "UPDATE localizacao SET Localizacao = ?, ativo = ? WHERE idLocalizacao = ?"
        );
        $upd->execute([$novalocalizacao, $ativo, $idLocalizacao]);
        return true;
    } catch (PDOException $e) {
        error_log('manterLocalizacao falhou: ' . $e->getMessage());
        return false;
    }
}

//manter os materiais
function manterMaterial($descricao,$patrimonio,$categoria,$tipomaterial,$idGrupoMaterial,$nome_imagem,$siape){

    $stmt = self::$con->prepare(
        "SELECT COUNT(*) FROM material
         WHERE idGrupoMaterial != ?
         AND idGrupoMaterial IN (
             SELECT idGrupoMaterial FROM (
                 SELECT idGrupoMaterial FROM material
                 WHERE NumPatrimonio = ? OR descricaoMat = ?
             ) AS t
         )"
    );
    $stmt->execute([$idGrupoMaterial, $patrimonio, $descricao]);
    if ((int) $stmt->fetchColumn() > 0) {
        return 0; // material já cadastrado
    }

    try {
        $upd = self::$con->prepare(
            "UPDATE material
             SET DescricaoMat = ?,
                 NumPatrimonio = ?,
                 TipoMaterial_idTipoMaterial = ?,
                 Categoria_idCategoria = ?,
                 FotoMaterial = ?,
                 Usuarios_Siape = ?
             WHERE idGrupoMaterial = ?"
        );
        $upd->execute([$descricao, $patrimonio, $tipomaterial, $categoria, $nome_imagem, $siape, $idGrupoMaterial]);
        return true;
    } catch (PDOException $e) {
        error_log('manterMaterial falhou: ' . $e->getMessage());
        return false;
    }
}

//tramita os materias
function tramitaMaterial($origem,$destino,$quantidade,$idmaterial,$motivo,$sublocalizacao,$siape,$idUsuario){

    // separa "idGrupoMaterial/idSubLocalizacao"
    $posicao  = strpos($idmaterial, '/');
    $idSubLoc = (int) substr($idmaterial, $posicao + 1, 4);
    $idMat    = (int) substr($idmaterial, 0, $posicao);

    $origem     = (int) $origem;
    $quantidade = (int) $quantidade;

    if ($quantidade <= 0) {
        return false;
    }

    $stmt = self::$con->prepare(
        "SELECT COUNT(Quantidade) FROM material
         WHERE idGrupoMaterial = ?
         AND localizacao_idlocalizacao = ?
         AND sublocalizacao_idSubLocalizacao = ?"
    );
    $stmt->execute([$idMat, $origem, $idSubLoc]);
    $nResultado = (int) $stmt->fetchColumn();

    if ($quantidade > $nResultado) {
        return false;
    }

    $stmt = self::$con->prepare(
        "SELECT idMaterial FROM material
         WHERE idGrupoMaterial = ?
         AND localizacao_idlocalizacao = ?
         AND sublocalizacao_idSubLocalizacao = ?
         ORDER BY idMaterial DESC LIMIT $quantidade"
    );
    $stmt->execute([$idMat, $origem, $idSubLoc]);

    $ids = [];
    while ($t = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ids[] = (int) $t['idMaterial'];
    }
    $tramitados = implode(',', $ids);

    try {
        self::$con->beginTransaction();

        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $upd = self::$con->prepare(
                "UPDATE material
                 SET Localizacao_idLocalizacao = ?, sublocalizacao_idSubLocalizacao = ?
                 WHERE idMaterial IN ($placeholders)"
            );
            $upd->execute(array_merge([$destino, $sublocalizacao], $ids));
        }

        $ins = self::$con->prepare(
            "INSERT INTO tramitacaomat
                (MotivoTramitacao, Material_idMaterial, Usuarios_idUsuario, Usuarios_Siape,
                 idLocalizacaoOrigem, idLocalizacaoDestino, Quantidade,
                 idMaterialTramitados, sublocalizacao_idSubLocalizacao)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $ins->execute([$motivo, $idMat, $idUsuario, $siape, $origem, $destino, $quantidade, $tramitados, $sublocalizacao]);

        self::$con->commit();
        return true;
    } catch (PDOException $e) {
        if (self::$con->inTransaction()) {
            self::$con->rollBack();
        }
        error_log('tramitaMaterial falhou: ' . $e->getMessage());
        return false;
    }
}

//Verifica se uma sublocalização é portátil, tramitável (bolsa, caixa, case, etc...)
function eTramitavel($idSublocalizacao){
    $consulta = self::$con->prepare(
        "SELECT tramitavel FROM sublocalizacao WHERE idSublocalizacao = ?"
    );
    $consulta->execute([$idSublocalizacao]);
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    return $resultado['tramitavel'] ?? null;
}

//A tramitação coletiva, quando aplicada a bolsa, case, caixa, tramita a sublocalização por meio dessa função
function tramitaSublocalizacao($destino,$sublocalizacaoOrigem){
    try {
        $stmt = self::$con->prepare(
            "UPDATE sublocalizacao SET Localizacao_idLocalizacao = ? WHERE idSubLocalizacao = ?"
        );
        $stmt->execute([$destino, $sublocalizacaoOrigem]);
        return true;
    } catch (PDOException $e) {
        error_log('tramitaSublocalizacao falhou: ' . $e->getMessage());
        return false;
    }
}

//tramita os materias coletivamente
function tramitacaoColetiva($origem,$destino,$motivo,$sublocalizacaoOrigem,$sublocalizacaoDestino,$siape,$idUsuario){

    $mensagem = true;

    // IDs distintos de grupos de materiais na sublocalização de origem
    $stmt = self::$con->prepare(
        "SELECT DISTINCT idGrupoMaterial FROM material
         WHERE localizacao_idlocalizacao = ? AND sublocalizacao_idSubLocalizacao = ?"
    );
    $stmt->execute([$origem, $sublocalizacaoOrigem]);

    while ($materias = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $idGrupoMaterial = (int) $materias['idGrupoMaterial'];

        // Conta quantos itens daquele grupo existem na sublocalização
        $q = self::$con->prepare(
            "SELECT COUNT(Quantidade) FROM material
             WHERE localizacao_idlocalizacao = ?
             AND sublocalizacao_idSubLocalizacao = ?
             AND idGrupoMaterial = ?"
        );
        $q->execute([$origem, $sublocalizacaoOrigem, $idGrupoMaterial]);
        $quantidade = (int) $q->fetchColumn();
        if ($quantidade <= 0) {
            continue;
        }

        $sel = self::$con->prepare(
            "SELECT idMaterial FROM material
             WHERE idGrupoMaterial = ?
             AND localizacao_idlocalizacao = ?
             AND sublocalizacao_idSubLocalizacao = ?
             ORDER BY idMaterial DESC LIMIT $quantidade"
        );
        $sel->execute([$idGrupoMaterial, $origem, $sublocalizacaoOrigem]);

        $ids = [];
        while ($t = $sel->fetch(PDO::FETCH_ASSOC)) {
            $ids[] = (int) $t['idMaterial'];
        }
        $tramitados = implode(',', $ids);

        try {
            self::$con->beginTransaction();

            $upd = self::$con->prepare(
                "UPDATE material
                 SET Localizacao_idLocalizacao = ?, sublocalizacao_idSubLocalizacao = ?
                 WHERE localizacao_idlocalizacao = ?
                 AND sublocalizacao_idSubLocalizacao = ?
                 AND idGrupoMaterial = ?"
            );
            $upd->execute([$destino, $sublocalizacaoDestino, $origem, $sublocalizacaoOrigem, $idGrupoMaterial]);

            $ins = self::$con->prepare(
                "INSERT INTO tramitacaomat
                    (MotivoTramitacao, Material_idMaterial, Usuarios_idUsuario, Usuarios_Siape,
                     idLocalizacaoOrigem, idLocalizacaoDestino, Quantidade,
                     idMaterialTramitados, sublocalizacao_idSubLocalizacao)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $ins->execute([$motivo, $idGrupoMaterial, $idUsuario, $siape, $origem, $destino, $quantidade, $tramitados, $sublocalizacaoDestino]);

            self::$con->commit();
        } catch (PDOException $e) {
            if (self::$con->inTransaction()) {
                self::$con->rollBack();
            }
            error_log('tramitacaoColetiva falhou: ' . $e->getMessage());
            $mensagem = false;
        }
    }

    return $mensagem;
}

//função para inserir novas localizações
function insereLocalizacao($localizacao){

    $stmt = self::$con->prepare("SELECT COUNT(*) FROM localizacao WHERE Localizacao = ?");
    $stmt->execute([$localizacao]);
    if ((int) $stmt->fetchColumn() >= 1) {
        return false; // localização já existe
    }

    try {
        $ins = self::$con->prepare("INSERT INTO localizacao (Localizacao) VALUES (?)");
        $ins->execute([$localizacao]);
        return true;
    } catch (PDOException $e) {
        error_log('insereLocalizacao falhou: ' . $e->getMessage());
        return false;
    }
}

//função para inserir novas sublocalizações
function insereSubLocalizacao($idLocalizacao,$sublocalizacao, $tramitavel){

    $stmt = self::$con->prepare(
        "SELECT COUNT(*) FROM sublocalizacao
         WHERE sublocalizacao = ? AND localizacao_idLocalizacao = ?"
    );
    $stmt->execute([$sublocalizacao, $idLocalizacao]);
    if ((int) $stmt->fetchColumn() > 0) {
        return false; // sublocalização já existe
    }

    try {
        $ins = self::$con->prepare(
            "INSERT INTO sublocalizacao (subLocalizacao, localizacao_idLocalizacao, tramitavel)
             VALUES (?, ?, ?)"
        );
        $ins->execute([$sublocalizacao, $idLocalizacao, $tramitavel]);
        return true;
    } catch (PDOException $e) {
        error_log('insereSubLocalizacao falhou: ' . $e->getMessage());
        return false;
    }
}


//função para inserir usuários
function insereUsuario($nome,$cpf,$email,$siape,$senha,$senha2){

    if ($senha !== $senha2) {
        return false; // senhas não conferem
    }

    $stmt = self::$con->prepare("SELECT COUNT(*) FROM usuarios WHERE siape = ?");
    $stmt->execute([$siape]);
    if ((int) $stmt->fetchColumn() >= 1) {
        return false; // usuário já existe
    }

    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO usuarios (CPF, email, NomeUsuario, Permissao_idPermissao, Senha, Siape)
                VALUES (?, ?, ?, 2, ?, ?)";
        $stmt = self::$con->prepare($sql);
        $stmt->execute([$cpf, $email, $nome, $senhaHash, $siape]);
        return true;
    } catch (PDOException $e) {
        error_log('insereUsuario falhou: ' . $e->getMessage());
        return false;
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
