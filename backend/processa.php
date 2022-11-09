<?php

include_once ("conexao.php");

arrayCreate();
var_dump($arrIDHtml);
$arrSql = addArraySql($arrIDHtml);
sqlInsert($arrSql);
sqlConection($conexao, $sql);

function arrayCreate(){

    $arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];

    $arrSql[0] = '';

    return $arrIDHtml;
    
}

//Coleta dados do HTML e adiciona em uma array
function addArraySql(&$arrIDHtml) {
    var_dump($arrIDHtml);
    $arrSql[0] = "id";
    for ($i = 1; $i <= 15; $i++)
    {
        $campo = $arrIDHtml[$i];
        array_push($arrSql, isset($_POST[$campo]) ? $_POST[$campo] : 'Sem ' + $campo);
    }
}

//Cria comando de Insert para BD
function sqlInsert($arrSql) {

    $sql = "INSERT INTO tabpro (TABPRO_Descricao, TABPRO_CodWHB, TABPRO_Fornecedor, TABPRO_VelCorte, TABPRO_Avanco, TABPRO_CompUsi, TABPRO_Nova_CustPast, TABPRO_Nova_QtdAresta, TABPRO_Nova_QtdPast, TABPRO_Nova_VidaUtil, TABPRO_Alisa_CustPast, TABPRO_Alisa_QtdAresta, TABPRO_Alisa_QtdPast, TABPRO_Alisa_VidaUtil, TABPRO_PrevProdAnual) VALUES ('$arrSql[1]', '$arrSql[2]', '$arrSql[3]', '$arrSql[4]', '$arrSql[5]', '$arrSql[6]', '$arrSql[7]', '$arrSql[8]', '$arrSql[9]', '$arrSql[10]', '$arrSql[11]', '$arrSql[12]', '$arrSql[13]', '$arrSql[14]', '$arrSql[15]')";

}

//Dispara comando de BD depois fecha a conexão
function sqlConection($conexao, $sql){

    $salvar = mysqli_query($conexao, $sql);

    $linhas = mysqli_affected_rows($conexao);

    mysqli_close($conexao);

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <h1>Teste</h1>
    <?php
        if ($linhas == 1) {
            print "Cadastro efetuado com sucesso!";
        }else {
            print "Cadastro não efetuado.<br>Já existe um usuário com este e-mail!";
        }
    ?>
</body>
</html>