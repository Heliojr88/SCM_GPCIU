<!DOCTYPE html>
<html lang="pt-Br">
    <head>
        <meta charset="utf-8" />
        <title>Código de Barras</title>
    </head>
    <body>
        <form action="#" method="post">
            Código de barras
            (<a href="http://zxing.appspot.com/scan?ret=http://www.agenciageeks.com.br/deposito/public/consultaMaterial.php?codigo={CODE}">Leitor</a>):
            <input type="text" name="cod" value="<?= $_GET['codigo'] ?>" />
        </form>
    </body>
</html>

