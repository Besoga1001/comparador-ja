<?php

$dbh = new PDO('mysql:host=localhost;dbname=troy_prot', 'root', '');

$sth = $dbh->prepare("SELECT TABPRO_ID, TABPRO_CodWHB, TABPRO_Descricao, TABPRO_Fornecedor FROM tabpro");
$sth->execute();

// Armazenar em uma variável os resultados obtidos
$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="shortcut icon" href="favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="">
    <title>Ferramentas Troy</title>
</head>
<body>
    <header>
        <h1 class="header-title">Ferramentas</h1>
    </header>
    <main>
        <div>
            <form action='../index.php'>
                <button type='submit' class="button blue" name='inicio'>Inicio</button>
            </form>
            <br>
            <form method='POST' action='/backend/crud.php'>
                <input type='submit' class="input blue" name='cadastrar' value='Cadastrar'>    
                <input type='submit' class="input blue" name='atualizar' value='Atualizar'>         
                <input type='submit' class="input blue" name='excluir' value='Excluir'>            
                <input type='submit' class="input blue" name='consultar' value='Consultar'>
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
                    for ($i = 0; $i < $tamResultados; $i++) {
                        $id = $resultados[$i]['TABPRO_ID'];
                        $codWhb = $resultados[$i]['TABPRO_CodWHB'];
                        $desc = $resultados[$i]['TABPRO_Descricao'];
                        $forn = $resultados[$i]['TABPRO_Fornecedor'];
                        echo '<tr>';
                        echo "<td>$id</td>";
                        echo "<td>$codWhb</td>";
                        echo "<td>$desc</td>";
                        echo "<td>$forn</td>";
                        echo "<td>";
                            echo "<button type='button' class='button green' name=$id>Editar</button>";
                            echo "<button type='button' class='button red' name=$id>Excluir</button>";
                        echo "</td>";
                        echo '</tr>';
                    }
                ?>               
            </tbody>
        </table>
        <div class="modal" id="modal">
            <div class="modal-content">
                <header class="modal-header">
                    <h2>Novo Cliente</h2>
                    <span class="modal-close" id="modalClose">&#10006;</span>
                </header>
                <form class="modal-form"> 
                    <input type="nome" class="modal-field" placeholder="Código">
                    <input type="e-mail" class="modal-field" placeholder="Código WHB"> 
                    <input type="celular" class="modal-field" placeholder="Descrição"> 
                    <input type="cidade" class="modal-field" placeholder="Fornecedor"> 
                </form>
                <footer class="modal-footer">
                    <button class="button green">Salvar</button>
                    <button class="button blue">Cancelar</button>
                </footer>
            </div>
        </div>
    </main>
    <footer>
        
    </footer>
</body>
</html>