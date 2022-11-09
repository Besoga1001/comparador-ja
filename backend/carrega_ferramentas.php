<?php

include_once ("conexao.php");

$sql = sqlSelect();
$arrConection = SqlConection($conexao, $sql);
$consulta = $arrConection[0];
$linhas = $arrConection[1];
while($exibirRegistros = mysqli_fetch_array($consulta)){
    echo "<option value='2' selected='selected'>desc</option>";
}


function arrayCreate(){

    $arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];

    return $arrIDHtml;

}

//Coleta dados do HTML e adiciona em uma array
function addArraySql($arrIDHtml) {
    $arrSql = [];
    $arrSql[0] = '';
    for ($i = 1; $i <= 15; $i++)
    {
        $campo = $arrIDHtml[$i];
        array_push($arrSql, isset($_POST[$campo]) ? $_POST[$campo] : 'Sem ' + $campo);
    }

    return $arrSql;
}

//Cria comando de Insert para BD
function sqlSelect() {

    $id = 1;

    $sql = "SELECT * FROM tabpro WHERE TABPRO_ID = $id;";

    return $sql;

}

//Dispara comando de BD depois fecha a conexão
function sqlConection($conexao, $sql){

    $consulta = mysqli_query($conexao, $sql);

    $linhas = mysqli_affected_rows($conexao);

    mysqli_close($conexao);

    $arrConection = [$consulta, $linhas];

    return $arrConection;

}


?>