<?php

//Desabilita mensagens de erro e warning
 //error_reporting(E_ERROR | E_PARSE);

include_once ("conexao.php");

$dbh = new PDO('mysql:host=localhost;dbname=troy_prot', 'root', '');

if (isset($_GET['id'])){
    $idPesq = $_GET['id'];
    $sth = $dbh->prepare("SELECT * FROM tabpro WHERE TABPRO_ID = '$idPesq'");
    $sth->execute();
    $resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
}

$mode = recieveMode();
$modoCRUD = $mode . '.php';

$arrLabelCampo = ["ID", "Descrição", "Código WHB", "Fornecedor", "Velocidade de Corte [m/min]", "Avanço [mm/min]", "Comprimento Usinado[mm]", "Custo Pastilha [R$]", "Qntd de Arestas", "Qntd de Pastilhas", "Vida Útil[pçs]", "Custo Pastilha (Alisadora) [R$]", "Qntd de arestas (Alisadora)", "Qntd de Pastilhas (Alisadora)", "Vida Util (Alisadora) [pçs]", "Previsão de produção anual [pçs]"];

$arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];

if (isset($idPesq)){
    $listResults = [$resultados[0]['TABPRO_ID'], $resultados[0]['TABPRO_Descricao'], $resultados[0]['TABPRO_CodWHB'], $resultados[0]['TABPRO_Fornecedor'], $resultados[0]['TABPRO_VelCorte'], $resultados[0]['TABPRO_Avanco'], $resultados[0]['TABPRO_CompUsi'], $resultados[0]['TABPRO_Nova_CustPast'], $resultados[0]['TABPRO_Nova_QtdAresta'], $resultados[0]['TABPRO_Nova_QtdPast'], $resultados[0]['TABPRO_Nova_VidaUtil'], $resultados[0]['TABPRO_Alisa_CustPast'], $resultados[0]['TABPRO_Alisa_QtdAresta'], $resultados[0]['TABPRO_Alisa_QtdPast'], $resultados[0]['TABPRO_Alisa_VidaUtil'], $resultados[0]['TABPRO_PrevProdAnual']];
}

function recieveMode() {
    if (isset($_GET['modo'])) {
        $mode = $_GET['modo'];
    }

    return $mode;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../frontend/crud/estilos/style.css">
        <link rel="stylesheet" href="../frontend/crud/estilos/button.css">
        <link rel="stylesheet" href="main.css">
        <link rel="shortcut icon" href="favicon-16x16.png" type="image/x-icon">
        <title>Ferramentas Troy</title>
    </head>
    <body>
        <header>
            <h2 class='header-title'>Informações de Cabeçalho</h2>
        </header>
        
        <form action='..\..\index.php'>
            <input type='submit' class='input blue' name='Ferramentas' value='Ferramentas'>
        </form>
        
        <?php

            echo "<form method='POST' action='$modoCRUD'>
                    <h2 class='header-area'>Informações da Ferramenta</h2><br>";

                if ($mode != 'Cadastrar'){
                    echo "<input type='text' class='escondido' id='$arrIDHtml[0]' name='$arrIDHtml[0]' value='$listResults[0]'>";
                }

                for ($i = 1; $i <= 3; $i++)
                {
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    $label = "<label for='$idHtml'>$label:</label>";
                    if ($mode == 'Excluir' Or $mode == 'Consultar') {
                        echo "$label <input type='text' id='$idHtml' name='$idHtml' class='quadrado' value='$listResults[$i]' readonly><br><br>";
                    } elseif ($mode == 'Editar') {
                        if ($idHtml == 'desc' || $idHtml == 'forn') {
                            echo "$label <input type='text' id='$idHtml' name='$idHtml' class='quadrado' value='$listResults[$i]' required><br><br>";
                        } else {
                            echo "$label <input type='text' id='$idHtml' name='$idHtml' class='quadrado' value='$listResults[$i]'><br><br>";
                        }
                    } else {
                        if ($idHtml == 'desc' || $idHtml == 'forn') {
                            echo "$label <input type='text' id='$idHtml' name='$idHtml' class='quadrado' required><br><br>"; 
                        } else {
                            echo "$label <input type='text' id='$idHtml' name='$idHtml' class='quadrado'><br><br>";
                        }
                    }
                }

                echo "<hr><h2 class='header-area'>Dados de Corte</h2><br>";
                
                for ($i = 4; $i <=6; $i++)
                {
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    $label = "<label for='$idHtml'>$label:</label>";
                    if ($mode == 'Excluir' Or $mode == 'Consultar') {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml'  name='$idHtml' onblur='tempUsi()' class='quadrado' value='$listResults[$i]' readonly><br><br>";
                    } elseif ($mode == 'Editar') {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' name='$idHtml' class='quadrado' value='$listResults[$i]'><br><br>";
                    } else {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' name='$idHtml' class='quadrado' ><br><br>";
                    }
                }

                echo "<hr><h2 class='header-area'>Informações de Custo</h2><br>";

                for ($i = 7; $i <= 15; $i++)
                {
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    $label = "<label for='$idHtml'>$label:</label>";
                    if ($mode == 'Excluir' Or $mode == 'Consultar') {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' name='$idHtml' class='quadrado' value='$listResults[$i]' readonly><br><br>";
                    } elseif ($mode == 'Editar') {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' name='$idHtml' class='quadrado' value='$listResults[$i]'><br><br>";
                    } else {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' name='$idHtml' class='quadrado' ><br><br>";
                    }
                }

                switch ($mode) {
                    case 'Cadastrar':
                        echo "<input type='submit' class='input blue' value='Inserir'><br></input><br>";
                        break;
                    case 'Editar':
                        echo "<input type='submit' class='input blue' value='Atualizar'><br></input><br>";
                        break;
                    case 'Excluir':
                        echo "<input type='submit' class='input blue' value='Excluir'><br></input><br>";
                        break;
                }
            echo "</form>";
        ?>
    </body>
</html>