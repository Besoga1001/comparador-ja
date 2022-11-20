<?php

############# NOVA PESQUISA

# Criar link com o DB
$dbh = new PDO('mysql:host=localhost;dbname=troy_prot', 'root', '');

# Verificar se tem algum filtro a ser pesquisado
if (isset($_GET['filtro'])){
    $filtro = $_GET['filtro'];
    # Criar o comando do SQL
    $sth = $dbh->prepare("SELECT TABPRO_ID, TABPRO_CodWHB, TABPRO_Descricao, TABPRO_Fornecedor FROM tabpro WHERE TABPRO_Descricao LIKE '%$filtro%'");
}
else{
    # Criar o comando do SQL
    $sth = $dbh->prepare("SELECT TABPRO_ID, TABPRO_CodWHB, TABPRO_Descricao, TABPRO_Fornecedor FROM tabpro ORDER BY TABPRO_ID");
}

# Executar comando
$sth->execute();

# Armazenar em uma variável os resultados obtidos
$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
# Contar a quantidade de resultados
$tamResultados = count($resultados);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/frontend/crud/estilos/main.css">
    <link rel="stylesheet" href="/frontend/crud/estilos/button.css">
    <link rel="stylesheet" href="/frontend/crud/estilos/records.css">
    <link rel="stylesheet" href="/frontend/crud/estilos/modal.css">
    <link rel="shortcut icon" href="frontend\crud\imagens\favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="">
    <title>Ferramentas Troy</title>
</head>
<body>
    <header>>
       
        <h1 class="header-title">Ferramentas</h1>
    </header>
    <main>
        <div>
            <form method='GET' action='/backend/crud.php'>
                <input type='submit' class="input blue" name='modo' value='Cadastrar ferr.'>          
            </form>
        </div>

        <div>
            <form method='GET' action=''>
                <label class=''>Nome produto: </label>
                <input type='text' class='' name='filtro'>
                <input type='submit' class='input blue' value='Pesquisar'>  
            </form>
            <form action='index.php'>
                <input type='submit' class='input blue' value='Limpar filtro'>  
            </form>
        </div>

        <table class="records">
            <thead>
                <tr>
                    <th class="white">Código</th>
                    <th class="white">Código WHB</th>
                    <th class="white">Descrição</th>
                    <th class="white">Fornecedor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Looping em todos os registros encontrados no DB
                    for ($i = 0; $i < $tamResultados; $i++) {
                        // Alocar os resultados nas variaveis
                        $id = $resultados[$i]['TABPRO_ID'];
                        $codWhb = $resultados[$i]['TABPRO_CodWHB'];
                        $desc = $resultados[$i]['TABPRO_Descricao'];
                        $forn = $resultados[$i]['TABPRO_Fornecedor'];
                        // Colocar as infos na linha
                        echo '<tr>';
                            echo "<td>$id</td>";
                            echo "<td>$codWhb</td>";
                            echo "<td>$desc</td>";
                            echo "<td>$forn</td>";
                            // Criar os botões de editar e excluir ferramenta
                            echo "<td>";
                                echo "<form method='GET' action='backend\crud.php'>";
                                    echo "<input type='submit' class='input green' name='modo' value='Editar'>"; 
                                    echo "<input type='submit' class='input red' name='modo' value='Excluir'>"; 
                                    echo "<input type='submit' class='input yellow' name='modo' value='Consultar'>";
                                    echo "<input type='hidden' name='id' value='$id'>";
                                echo "</form>";
                            echo "</td>";
                        echo '</tr>';
                    }
                ?>               
            </tbody>
        </table>
    </main>
</body>
</html>