<?php

include_once ("conexao.php");

$sql = "SELECT * FROM tabpro ORDER BY TABPRO_Descricao";
$consulta = mysqli_query($conexao, $sql);
$registros = mysqli_num_rows($consulta);

?>

<?php
# Se houver um item selecionado, pesquisar o item no SQL e coletar informações registradas.
$itemPesquisado = isset($_GET["ferramenta1"])?$_GET["ferramenta1"]:"";
if($itemPesquisado <> ""){
    # Gerar o comando no SQL
    $sql = "SELECT * FROM tabpro WHERE TABPRO_ID LIKE '$itemPesquisado'";
    # Conectar ao SQL e enviar o comando gerado
    $consultaFerramenta = mysqli_query($conexao, $sql);
    # Colocar em uma variável array a pesquisa feita
    $registroFerramenta = mysqli_fetch_array($consultaFerramenta);
    # Colocar o ID do item pesquisado em uma variável
    $idFerramenta1 = $registroFerramenta[0];
    # Colocar a Descrição do item pesquisado em uma variável
    $descricaoFerramenta1 = $registroFerramenta[1];
    # Colocar o Fornecedor do item pesquisado em uma variável
    $fornecedorFerramenta1 = $registroFerramenta[3];
}
else{
    ## Caso nao tenha um retorno na pesquisa:
    #ID ferramenta vazio
    $idFerramenta1 = '';
    #Descrição ferramenta vazio
    $descricaoFerramenta1 = '';
    #Fornecedor ferramenta vazio
    $fornecedorFerramenta1 = '';
}

# Lista de nomes das labels que aparecerão do lado das Inputs
$arrLabelCampo = ["ID", "Descrição", "Código WHB", "Fornecedor", "Velocidade de Corte [m/min]", "Velocidade de Avanço [mm/min]", "Comprimento Usinado[mm]", "Custo Pastilha [R$]", "Qntd de Arestas", "Qntd de Pastilhas", "Vida Útil[pçs]", "Custo Pastilha (Alisadora) [R$]", "Qntd de arestas (Alisadora)", "Qntd de Pastilhas (Alisadora)", "Vida Util (Alisadora) [pçs]", "Previsão de produção anual [pçs]"];

# Lista de nomes dos InputBox que aparecerão do lado das Labels
$arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];

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

        if (!isNaN(avanco) && !isNaN(compusi))
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
        <title>Comparador</title>
    </head>
    <body>
        <!-- Botão para acessar a página de Consultas -->
        <form action='consulta.php'>
            <button type='submit' name='cadastro'>Consulta</button>
        </form>

        <!-- 
        ################################################ 
        ###############  CAMPOS DE TESTE  ##############
        ################################################ 
        -->
        <form method="POST" action="processa.php">
            <?php
            # Looping For para inserir as labels e os input box a aprtir da lista criada no cabeçalho da página
                for ($i = 1; $i <= 3; $i++)
                {
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    echo "$label: <input type='text' id='$idHtml' name='$idHtml'><br>";
                }
                
                # Inserir a Label e input de Vel. de Avanço e Comprimento Usinado
                for ($i = 5; $i <=6; $i++){
                    $label = $arrLabelCampo[$i];
                    $idHtml = $arrIDHtml[$i];
                    echo "$label: <input type='number' id='$idHtml' value='0' name='$idHtml' onblur='tempUsi()'><br>";
                }

                $idHtml = "tempusi";
                echo "Tempo de Usinagem: <input type='text' id=$idHtml value='0'>"
            ?>
            <!-- Salvar as informações inseridas na inputbox -->
            <br>
            <input type="submit" value="Salvar"><br>
            Descrição: <input type="text" id="codwhb2" onblur="letraMaius('codwhb2')"><br>
        </form>
    </body>
</html>