<?php

include_once ("conexao.php");

# Lista de nomes dos InputBox que aparecerão do lado das Labels
$arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];

$arrInsert[0] = 'id';

for ($i = 1; $i <= 15; $i++)
{
    $campo = $arrIDHtml[$i];
    array_push($arrInsert, isset($_POST[$campo]) ? $_POST[$campo] : 'Sem ' + $campo);
}

//var_dump($_POST);

$sql = "INSERT INTO tabpro (TABPRO_Descricao, TABPRO_CodWHB, TABPRO_Fornecedor, TABPRO_VelCorte, TABPRO_Avanco, TABPRO_CompUsi, TABPRO_Nova_CustPast, TABPRO_Nova_QtdAresta, TABPRO_Nova_QtdPast, TABPRO_Nova_VidaUtil, TABPRO_Alisa_CustPast, TABPRO_Alisa_QtdAresta, TABPRO_Alisa_QtdPast, TABPRO_Alisa_VidaUtil, TABPRO_PrevProdAnual) VALUES ('$arrInsert[1]', '$arrInsert[2]', '$arrInsert[3]', '$arrInsert[4]', '$arrInsert[5]', '$arrInsert[6]', '$arrInsert[7]', '$arrInsert[8]', '$arrInsert[9]', '$arrInsert[10]', '$arrInsert[11]', '$arrInsert[12]', '$arrInsert[13]', '$arrInsert[14]', '$arrInsert[15]')";

$salvar = mysqli_query($conexao, $sql);

$linhas = mysqli_affected_rows($conexao);

mysqli_close($conexao);

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