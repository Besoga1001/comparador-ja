<?php

    include_once ("conexao.php");

    $linhas = Update($conexao);

    function Update($conexao) {
        
        $id = addID();
        $sql = sqlDelete($id);
        $linhas = sqlConection($conexao, $sql);

        return $linhas;

    }

    function addID() {

        $id = isset($_POST['id']) ? $_POST['id'] : 'Sem ' + 'id';

        return $id;
        
    }

    function sqlDelete($id) {

        $sql = "DELETE FROM tabpro WHERE TABPRO_ID = $id";

        return $sql;

    }

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
            print "Exclusão efetuada com sucesso!";
        }else {
            print "Exclusão não efetuada.<br>Nenhum registro foi apagado.";
        }

    ?>

    <br><hr>
    <form method='get' action='../index.php'>
        <input type='submit' class="input blue" name='modo' value='Ferramentas'>
    </form>
    
</body>
</html>