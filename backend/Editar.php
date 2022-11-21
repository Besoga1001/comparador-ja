<?php

    include_once ("conexao.php");

    $linhas = Update($conexao);

    function Update($conexao) {
        $arrIDHtml = arrayCreate();
        $arrSql = addArraySql($arrIDHtml);
        $sql = sqlUpdate($arrSql);
        $linhas = sqlConection($conexao, $sql);

        return $linhas;

    }

    function arrayCreate(){

        $arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];

        return $arrIDHtml;

    }

    //Coleta dados do HTML e adiciona em uma array
    function addArraySql($arrIDHtml) {
        $arrSql = [];
        for ($i = 0; $i <= 15; $i++)
        {
            $campo = $arrIDHtml[$i];
            array_push($arrSql, isset($_POST[$campo]) ? $_POST[$campo] : 'Sem ' + $campo);
        }

        return $arrSql;
        
    }

    function sqlUpdate($arrSql) {

        $sql = "UPDATE tabpro SET 
        TABPRO_Descricao       = '$arrSql[1]',
        TABPRO_CodWHB          = '$arrSql[2]', 
        TABPRO_Fornecedor      = '$arrSql[3]', 
        TABPRO_VelCorte        = '$arrSql[4]', 
        TABPRO_Avanco          = '$arrSql[5]', 
        TABPRO_CompUsi         = '$arrSql[6]', 
        TABPRO_Nova_CustPast   = '$arrSql[7]', 
        TABPRO_Nova_QtdAresta  = '$arrSql[8]', 
        TABPRO_Nova_QtdPast    = '$arrSql[9]', 
        TABPRO_Nova_VidaUtil   = '$arrSql[10]', 
        TABPRO_Alisa_CustPast  = '$arrSql[11]', 
        TABPRO_Alisa_QtdAresta = '$arrSql[12]', 
        TABPRO_Alisa_QtdPast   = '$arrSql[13]', 
        TABPRO_Alisa_VidaUtil  = '$arrSql[14]',
        TABPRO_PrevProdAnual   = '$arrSql[15]'
        WHERE TABPRO_ID = $arrSql[0]";

        return $sql;

    }

    //Dispara comando de BD depois fecha a conexão
    function sqlConection($conexao, $sql){

        mysqli_query($conexao, $sql);

        $linhas = mysqli_affected_rows($conexao);

        mysqli_close($conexao);

        return $linhas;

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/frontend/crud/estilos/button.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferramentas Troy</title>
</head>
<body>
    <?php
        if ($linhas == 1) {
            print "Atualização efetuada com sucesso!";
        }else {
            print "Atualização não efetuada.<br>Nenhum campo foi alterado.";
        }

    ?>

    <br><hr>
    <form method='get' action='../index.php'>
        <input type='submit' class="input blue" name='modo' value='Ferramentas'>
    </form>
    
</body>
</html>