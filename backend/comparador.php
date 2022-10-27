<?php

include_once ("conexao.php");

$sql = "SELECT TABPRO_ID, TABPRO_Descricao, TABPRO_Fornecedor FROM tabpro ORDER BY TABPRO_Descricao";
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
?>

<?php
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
        /* Colocar na variável valor, o valor do campo escolhido através do ID e substituir a "," por ".", já q o DB para numeros Float aceita apenas a vírugla. */
        var valor = document.getElementById(valor_campo).value.replace(',', '.');
        /* Retornar como Float a variável valor */
        return parseFloat(valor);
    }

    /* Função que soma os valores */
    function somaTempUsi()
    {
        /* Colocar na variável a soma dos valores obtidos */
        vlr1 = getValor("avanco");
        vlr2 = getValor("compusi");
        if (!isNaN(vlr1) && !isNaN(vlr2)){
            var total = getValor("avanco") + getValor("compusi");
            id('resTempUsi').value = total;
        }
        else{
            id('resTempUsi').value = 0;
        }
    }
</script>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Ferramentas Troy</title>
        <link rel="stylesheet" href="/frontend/comparador/estilos/style.css">
    </head>

    <body>

        <header>
            <div class="cabecalho">
                <h1><img src="logo-troy.png"></h1>
                <ul>
                    <il><img class="imagem" src="/frontend/comparador/imagens/telefone-troy.png">+55(41)3349-3002</il>
                    <il><img class ="imagem" src="/frontend/comparador/imagens/email-troy.png" alt="">vendas@ferramentastroy.com.br</il>
                    <il><img class= "imagem" src="/frontend/comparador/imagens/localizacao-troy.png" alt="">R. Wiegando Olsen, 724 - Cidade Industrial Curitiba - PR, 81460-070</il>
                </ul>
            </div>

            <div class="conteudo">
                <h2>Tela de comparação</h2>
            </div>
        |</header>
        
        <table>
            <tr>
                <th>COMPARATIVO TÉCNICO</th> <!cabeçalho da tabela>
                <th>Modelo 1</th>
                <th>Modelo 2</th>
            </tr>
            <tr>
                <td>DESCRIÇÃO</td> <!registros da tabela>
                <td>BROCA XYZ123</td>
                <td>BROCA XYZ456</td>
            </tr>
            <tr>
                <td> CÓDIGO WHB</td>
                <td>-</td>
                <td>-</td>
            </tr>
            <tr>
                <td>FORNECEDOR</td>
                <td>X</td>
                <td>TROY</td>                
            </tr>

            <tr>
                <th colspan="3">DADOS DE CORTE</th>
            </tr>
            
            <tr>
                <td>VELOCIDADE DE CORTE [m/min]</td>
                <td class="blue">300</td>
                <td class="blue">300</td>
            </tr>

            <tr>
                <td>AVANÇO [mm/min]</td>
                <td class="blue">435</td>
                <td class="blue">435</td>
            </tr>

            <tr>
                <td>COMPRIMENTO USINADO [mm]</td>
                <td class="blue">37,7</td>
                <td class="blue">37,7</td>
            </tr>

            <tr>
                <td>TEMPO DE USINAGEM [minutos]</td>
                <td class="blue">0,09</td>
                <td class="blue">0,09</td>
            </tr>

            <tr>
                <th colspan="3">INFORMAÇÕES DE CUSTO</th>
            </tr>

            <tr>
                <td>CUSTO PASTILHAS NOVAS [R$]</td>
                <td class="blue">R$ 28,94</td>
                <td class="blue">R$ 25,94</td>
            </tr>

            <tr>
                <td>QTDE DE ARESTAS</td>
                <td class="blue">6</td>
                <td class="blue">6</td>
            </tr>

            <tr>
                <td>QTDE DE PASTILHAS/FERRAMENTA</td>
                <td class="blue">1</td>
                <td class="blue">1</td>
            </tr>

            <tr>
                <td>CUSTO PASTILHAS ALISADORA [R$]</td>
                <td class="blue"></td>
                <td class="blue"></td>
            </tr>

            <tr>
                <td>QTDE DE ARESTAS PAST. ALISADORA</td>
                <td class="blue"></td>
                <td class="blue"></td>
            </tr>

            <tr>
                <td>QTDE DE PAST. ALISADORA/FERRAM.</td>
                <td class="blue"></td>
                <td class="blue"></td>
            </tr>

            <tr>
                <td>VIDA ÚTIL [pçs]</td>
                <td class="blue">180</td>
                <td class="blue">200</td>
            </tr>

            <tr>
                <td>VIDA ÚTIL PAST. ALISADORA [pçs]</td>
                <td class="blue"></td>
                <td class="blue"></td>
            </tr>

            <tr>
                <td>CUSTO DE FERR./PÇ [R$/pç]</td>
                <td class="blue">R$ 0,03</td>
                <td class="blue">R$ 0,02</td>
            </tr>

            <tr>
                <td>PREVISÃO DE PROD.ANUAL [pçs]</td>
                <td class="blue">2029716</td>
                <td class="blue">2029716</td>
            </tr>

            <tr>
                <td>CUSTO DE FERRAM./ANO [R$]</td>
                <td class="blue">R$ 54.388,87</td>
                <td class="blue">R$ 43.875,69</td>
            </tr>

            <tr>
                <td>RED. CUSTO ANUAL [R$]</td>
                <td class="blue"></td>
                <td class="blue">R$ 10.513,18</td>
            </tr>

            <tr>
                <td>RED. CUSTO/PÇ ANUAL [%]</td>
                <td class="blue"></td>
                <td class="blue">19%</td>
            </tr>

            <tr class="amarelo">
                <td>PREVISÃO DE CONSUMO MENSAL</td>
                <td>157</td>
                <td>141</td>
            </tr>
        
        </table>

        <br>
        <br>
        <br>
        
    </body>

    <footer>
        
    </footer>
    <body>
        <!-- Botão para acessar a tela do Inicio -->
        <form action='../index.php'>
            <button type='submit' name='inicio'>Inicio</button>
        </form>
        <br>
        <!-- Criar um form -->
        <form method="get" action="">
            <!-- Criar Label para informar que deve ser selecionada uma ferramenta -->
            <label for="ferramenta1">Escolha a Ferramenta 1:</label>
            <!-- Criar uma ListBox com o nome de todas as ferramentas que tem no DB -->
            <select name="ferramenta1" id="ferramenta1">
                <!-- Primeiro item vai ser o "Selecione" -->
                <option value="">Selecione</option>
                <?php
                    # Enquanto tiver um item a ser mostrado no DB, continuar com o looping
                    while($exibirRegistros = mysqli_fetch_array($consulta)){
                        # Id será o item 0 da lista gerada
                        $id = $exibirRegistros[0];
                        # Descrição será o item 1 da lista gerada
                        $descricao = $exibirRegistros[1];
                        # Caso o ID seja igual ao ID pesquisado previamente pelo usuário, ele será automaticamente selecionado
                        if($id == $idFerramenta1){
                            echo "<option value='$id' selected='selected'>$descricao</option>";
                        }
                        # Caso contrário apenas adiciona o item na lista
                        else{
                            echo "<option value='$id'>$descricao</option>";
                        }
                    }
                ?>
            </select>
            <!-- Botão de "Pesquisar" item selecionado na ListBox -->
            <input type="submit" value="Pesquisar">
        </form>
        <br>
        <!-- Formulário de Informações a serem apresentadas da ferramenta -->
        <form method="get" action="processa.php">
            <!-- Criar a label de Descrição -->
            <!-- Caso tenha algo na variável de Descrição, colocar como Value na input de Descrição -->
            Descrição: <input type="text" name="desc" value="<?php if($descricaoFerramenta1 <> ''){echo $descricaoFerramenta1;}
                else{echo '';}?>" required autofocus><br>
            <!-- Criar Label de FOrnecedor -->
            <!-- Caso tenha algo na variável de Fornecedor, colocar como Value na input de Descrição -->
            Fornecedor: <input type="text" name="forn" value="<?php 
            if(empty($registroFerramenta[3])){
                    echo '';
                }
                else{
                    echo $registroFerramenta[3];
                }
                ?>"required>
            <br>
            <!-- Botão apra salvar as informações inseridas nos campos -->
            <input type="submit" value="Salvar">
        </form>
        <br>
        <hr>
        <br>

        <!-- 
        ################################################ 
        ###############  CAMPOS DE TESTE  ##############
        ################################################ 
        -->
        <form method="post" action="processa.php">
            <?php
            # Looping For para inserir as labels e os input box a aprtir da lista criada no cabeçalho da página
                if (empty($registroFerramenta)) 
                {
                    for ($i = 1; $i <= 3; $i++)
                    {
                        $label = $arrLabelCampo[$i];
                        $nameHtml = $arrIDHtml[$i];
                        echo "$label: <input type='text' id='$nameHtml'><br>";
                    }
                }
                else
                {
                    for ($i = 1; $i <= 3; $i++)
                    {
                        $label = $arrLabelCampo[$i];
                        $nameHtml = $arrIDHtml[$i];
                        $valor = $registroFerramenta[$i];
                        echo "$label: <input type='text' id='$nameHtml' value='$valor'><br>";
                    }
                }
                
                # Inserir a Label e input de Vel. de Avanço e Comprimento Usinado
                for ($i = 5; $i <=6; $i++){
                    $label = $arrLabelCampo[$i];
                    $nameHtml = $arrIDHtml[$i];
                    echo "$label: <input type='number' id='$nameHtml'  value='0' onblur='somaTempUsi()'><br>";
                }
            ?>
            <!-- Criar a label de Tempo de Usinagem -->
            Tempo de usinagem:
            <input name="resTempUsi" readonly id="resTempUsi" value="0">
            <!-- Salvar as informações inseridas na inputbox -->
            <br>
            <input type="submit" value="Salvar">
        </form>
    </body>
</html>