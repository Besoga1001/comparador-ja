<?php

//Desabilita mensagens de erro e warning
// error_reporting(E_ERROR | E_PARSE);

include_once ("conexao.php");

$mode = recieveMode();

// Lista de nomes das labels que aparecerão do lado das Inputs
$arrLabelCampo = ["ID", "Descrição", "Código WHB", "Fornecedor", "Velocidade de Corte [m/min]", "Avanço [mm/min]", "Comprimento Usinado[mm]", "Custo Pastilha [R$]", "Qntd de Arestas", "Qntd de Pastilhas", "Vida Útil[pçs]", "Custo Pastilha (Alisadora) [R$]", "Qntd de arestas (Alisadora)", "Qntd de Pastilhas (Alisadora)", "Vida Util (Alisadora) [pçs]", "Previsão de produção anual [pçs]"];

// Lista de nomes dos InputBox que aparecerão do lado das Labels
$arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];

function recieveMode() {
    if ($_GET['modo'] != '') {
        $mode = $_GET['modo'];
    }

    return $mode;
}
?>

<script type="text/javascript">
    /* LINK DO VÍDEO PARA EXECUÇÃO DA SOMA 
    https://www.youtube.com/watch?v=_f6RYUjDlMk */

    /* Função para retornar o valor para o ID do campo escolhido */
    function id(valor_campo)
    {
        return document.getElementById(valor_campo);
    }

    /* Função para Coletar o valor de um campo HTML*/
    function getValor(valor_campo)
    {
        /* Coletar valor de um campo específico */
        var valor = document.getElementById(valor_campo).value.replace(',', '.');
        return valor;
    }

    function tempUsi()
    {
        avanco = getValor("avanco");
        compusi = getValor("compusi");

        if (!isNaN(avanco) && !isNaN(compusi) && !isNaN(velcorte))
        {
            var total = compusi / avanco;
            total = total.toFixed(2);
            id('tempusi').value = total;
        }
        else
        {
            id('tempusi').value = 0;
        }
    }

</script>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="favicon-16x16.png" type="image/x-icon">
        <title>Ferramentas Troy</title>
    </head>
    <body>
        
        <!-- Botão para acessar a página de Consultas -->
        <form action='..\..\index.php'>
            <button type='submit' name='cadastro'>Ferramentas</button>
        </form>

        <form method="POST" action="processa.php">
            <h2>Informações de Cabeçalho</h2>
            <br>
            <?php
                // Looping For para inserir as labels e os input box a partir da lista criada no cabeçalho da página (Tipo texto)
                for ($i = 1; $i <= 3; $i++)
                {
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    $label = "<label for='$idHtml'>$label:</label>";
                    if ($mode != 'Cadastrar') {
                        echo "$label <input type='text' id='$idHtml' name='$idHtml' readonly><br><br>";
                    } else {
                        if ($idHtml == 'desc' || $idHtml == 'forn') {
                            echo "$label <input type='text' id='$idHtml' name='$idHtml' required><br><br>"; 
                        } else {
                        echo "$label <input type='text' id='$idHtml' name='$idHtml'><br><br>";
                        }
                    }
                }

                echo "<br><hr><h2>Dados de Corte</h2><br>";
                
                // Inserir a Label e input de Vel. de Avanço e Comprimento Usinado (Tipo Number)
                for ($i = 4; $i <=6; $i++)
                {
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    $label = "<label for='$idHtml'>$label:</label>";
                    if ($mode != 'Cadastrar') {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' value='0' name='$idHtml' onblur='tempUsi()' readonly><br><br>";
                    } else {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' value='0' name='$idHtml' onblur='tempUsi()'><br><br>"; 
                    }
                }

                $idHtml = "tempusi";
                echo "Tempo de Usinagem: <input type='text' id=$idHtml value='0' readonly>";

                echo "<br><br><hr><h2>Informações de Custo</h2><br>";

                // Looping For para inserir as labels e os input box a partir da lista criada no cabeçalho da página (Tipo texto)
                for ($i = 7; $i <= 15; $i++)
                {
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    $label = "<label for='$idHtml'>$label:</label>";
                    if ($mode != 'Cadastrar') {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' name='$idHtml' readonly><br><br>";
                    } else {
                        echo "$label <input type='number' min='0' step='0.1' id='$idHtml' name='$idHtml'><br><br>";
                    }
                }


                if ($mode == 'Cadastrar'){
                    echo "<input type='submit' value='Inserir'><br></input>";
                } elseif ($mode == 'Atualizar') {
                    echo "<input type='submit' value='Atualizar'><br></input>";
                }

            ?>
        </form>
    </body>
</html>