<?php

include_once ("conexao.php");

// $desc = isset($_POST['desc']) ? $_POST['desc'] : 'Sem desc';
// $forn = isset($_POST['forn']) ? $_POST['forn'] : 'Sem Forn';

$arrInsert = json_decode($_POST['result'], true);

echo $arrInsert;

var_dump($_POST);

$sql = "INSERT INTO tabpro (TABPRO_Descricao, TABPRO_Fornecedor) VALUES ('$arrInsert[1]', '$arrInsert[2]')";
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