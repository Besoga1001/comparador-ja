<?php

include_once ("conexao.php");

$sql = "SELECT TABPRO_ID, TABPRO_Descricao, TABPRO_Fornecedor FROM tabpro ORDER BY TABPRO_Descricao";
$consulta = mysqli_query($conexao, $sql);
$registros = mysqli_num_rows($consulta);


############# NOVA PESQUISA
# Criar link com o DB
$dbh = new PDO('mysql:host=localhost;dbname=troy_prot', 'root', '');

# Criar o comando do SQL
$sth = $dbh->prepare("SELECT TABPRO_ID, TABPRO_Descricao FROM tabpro");
# Executar comando
$sth->execute();

# Armazenar em uma variável os resultados obtidos
$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
# Contar a quantidade de resultados
$tamResultados = count($resultados);


###################### FERRAMENTA 1
# Se houver um item selecionado, pesquisar o item no SQL e coletar informações registradas.
$itemPesquisado = isset($_GET["ferramenta1"])?$_GET["ferramenta1"]:"";
if($itemPesquisado <> ""){
    # Gerar o comando no SQL
    $sql = "SELECT * FROM tabpro WHERE TABPRO_ID LIKE '$itemPesquisado'";
    # Conectar ao SQL e enviar o comando gerado
    $consultaFerramenta = mysqli_query($conexao, $sql);
    # Colocar em uma variável array a pesquisa feita
    $caracFerr1 = mysqli_fetch_array($consultaFerramenta);
}
else{
    ## Caso nao tenha um retorno na pesquisa:
    #ID ferramenta vazio
    $caracFerr1 = ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
}
# Colocar o ID em uma variável
$idFerramenta1 = $caracFerr1[0];
# Colocar Fornecedor em uma variável
$forn1 = $caracFerr1[3];

###################### FERRAMENTA 2
# Se houver um item selecionado, pesquisar o item no SQL e coletar informações registradas.
$itemPesquisado = isset($_GET["ferramenta2"])?$_GET["ferramenta2"]:"";
if($itemPesquisado <> ""){
    # Gerar o comando no SQL
    $sql = "SELECT * FROM tabpro WHERE TABPRO_ID LIKE '$itemPesquisado'";
    # Conectar ao SQL e enviar o comando gerado
    $consultaFerramenta = mysqli_query($conexao, $sql);
    # Colocar em uma variável array a pesquisa feita
    $caracFerr2 = mysqli_fetch_array($consultaFerramenta);
}
else{
    ## Caso nao tenha um retorno na pesquisa:
    #ID ferramenta vazio
    $caracFerr2 = ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
}
# Colocar o ID em uma variável
$idFerramenta2 = $caracFerr2[0];
# Colocar Fornecedor em uma variável
$forn2 = $caracFerr2[3];


######################## LISTAS DE NOMES DE ID
# Lista de nomes dos InputBox que aparecerão do lado das Labels
$arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "prevprod"];


######################## FUNÇÕES DE COMPARAÇÃO
## Quando o primeiro valor for MAIOR, o que deve aparecerá
function vlr1Maior ($valor1, $valor2, $forn1, $forn2, $vlrReal = 0){
    // Verificar valor 1
    if (!empty($valor1) && $valor1 !== '-')
        {
            if ($vlrReal == 1)
            {
                $valor1 = str_replace('.', ',', round($valor1, 2), $valor1);
                echo "<td class='blue'>R$ $valor1</td>";
            }
            else{
                $valor1 = str_replace('.', ',', $valor1);
                echo "<td class='blue'>$valor1</td>";
            }
        }
    else
        {
            $valor1 = '-';
            echo "<td class='blue'>$valor1</td>";
        }
    // Verificar valor 2
    if (!empty($valor2) && $valor2 !== '-')
        {
            if ($vlrReal == 1)
            {
                $valor2 = str_replace('.', ',', round($valor2, 2), $valor2);
                echo "<td class='blue'>R$ $valor2</td>";
            }
            else{
                $valor2 = str_replace('.', ',', $valor2);
                echo "<td class='blue'>$valor2</td>";
            }
        }
    else
        {
            $valor2 = '-';
            echo "<td class='blue'>$valor2</td>";
        }
    // Verificar qual o melhor Fornecedor
    if ($valor1 != '-' && $valor2 != '-'){
        if ($valor1 > $valor2){
            echo "<td class='blue'>$forn1</td>";
            }
        elseif ($valor1 < $valor2){
            echo "<td class='blue'>$forn2</td>";
            }
        else{
            echo "<td class='blue'>-</td>";
        }
        }
    else{
        echo "<td class='blue'>-</td>";
    }
}

## Quando o primeiro valor for MENOR, o que deve aparecerá
function vlr1Menor ($valor1, $valor2, $forn1, $forn2, $vlrReal = 0){
    // Verificar valor 1
    if (!empty($valor1) && $valor1 !== '-')
        {
            if ($vlrReal == 1)
            {
                $valor1 = str_replace('.', ',', round($valor1, 2), $valor1);
                echo "<td class='blue'>R$ $valor1</td>";
            }
            else{
                $valor1 = str_replace('.', ',', $valor1);
                echo "<td class='blue'>$valor1</td>";
            }
        }
    else
        {
            $valor1 = '-';
            echo "<td class='blue'>-</td>";
        }
    // Verificar valor 2
    if (!empty($valor2) && $valor2 !== '-')
        {
            if ($vlrReal == 1)
            {
                $valor2 = str_replace('.', ',', round($valor2, 2), $valor2);
                echo "<td class='blue'>R$ $valor2</td>";
            }
            else{
                $valor2 = str_replace('.', ',', $valor2);
                echo "<td class='blue'>$valor2</td>";
            }
        }
    else
        {
            $valor2 = '-';
            echo "<td class='blue'>-</td>";
        }
    // Verificar qual o melhor Fornecedor
    if ($valor1 != '-' && $valor2 != '-'){
        if ($valor1 < $valor2){
            echo "<td class='blue'>$forn1</td>";
            }
        elseif ($valor1 > $valor2){
            echo "<td class='blue'>$forn2</td>";
            }
        else{
            echo "<td class='blue'>-</td>";
        }
        }
    else{
        echo "<td class='blue'>-</td>";
    }
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
                <h1><img src="/frontend/comparador/imagens/logo-troy.png"></h1>
                <ul>
                    <il><img class="imagem" src="../frontend/comparador/imagens/telefone-troy.png">+55(41)3349-3002</il>
                    <il><img class ="imagem" src="../frontend/comparador/imagens/email-troy.png" alt="">vendas@ferramentastroy.com.br</il>
                    <il><img class= "imagem" src="../frontend/comparador/imagens/localizacao-troy.png" alt="">R. Wiegando Olsen, 724 - Cidade Industrial Curitiba - PR, 81460-070</il>
                </ul>
            </div>

            <div class="conteudo">
                <form action='../index.php'>
                    <button type='submit' class="button blue" name='inicio'>Inicio</button>
                </form>
                <h2>Tela de comparação</h2>
            </div>
        </header>

        <table>
            <tr>
                <th>COMPARATIVO TÉCNICO</th> <!-- Cabeçalho da tabela -->
                <th>Ferramenta 1</th>
                <th>Ferramenta 2</th>
                <th>Resultado</th>
            </tr>
            <tr>
                <td>DESCRIÇÃO</td> <!-- Registros da tabela -->
                <form action=''>
                    <td>
                        <select name="ferramenta1" id="ferramenta1">
                            <!-- Primeiro item vai ser o "Selecione" -->
                            <option value="">Selecione</option>
                            <?php
                                # Enquanto tiver um item a ser mostrado no DB, continuar com o looping
                                for ($i=0; $i < $tamResultados; $i++){
                                    # Id será o item 0 da lista gerada
                                    $id = $resultados[$i]['TABPRO_ID'];
                                    # Descrição será o item 1 da lista gerada
                                    $descricao = $resultados[$i]['TABPRO_Descricao'];
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
                    </td>
                    <td>
                        <select name="ferramenta2" id="ferramenta2">
                            <!-- Primeiro item vai ser o "Selecione" -->
                            <option value="">Selecione</option>
                            <?php
                                # Enquanto tiver um item a ser mostrado no DB, continuar com o looping
                                for ($i=0; $i < $tamResultados; $i++){
                                    # Id será o item 0 da lista gerada
                                    $id = $resultados[$i]['TABPRO_ID'];
                                    # Descrição será o item 1 da lista gerada
                                    $descricao = $resultados[$i]['TABPRO_Descricao'];
                                    # Caso o ID seja igual ao ID pesquisado previamente pelo usuário, ele será automaticamente selecionado
                                    if($id == $idFerramenta2){
                                        echo "<option value='$id' selected='selected'>$descricao</option>";
                                    }
                                    # Caso contrário apenas adiciona o item na lista
                                    else{
                                        echo "<option value='$id'>$descricao</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                <td>
                        <button type='submit' class="button blue" name='pesquisar'>Pesquisar</button>
                    </td>
                </form>
            </tr>
            <tr>
                <td> CÓDIGO WHB</td>
                <?php
                    // Carregar Código da ferramenta 1
                    if (!empty($caracFerr1[2]))
                        {
                            $valor1 = $caracFerr1[2]; 
                            echo "<td>$valor1</td>";

                        }
                    else
                        {
                            $valor1 = '-';
                            echo "<td>$valor1</td>";
                        }
                    // Carregar Código da ferramenta 2
                    if (!empty($caracFerr2[2]))
                        {
                            $valor2 = $caracFerr2[2]; 
                            echo "<td>$valor2</td>";

                        }
                    else
                        {
                            $valor2 = '-';
                            echo "<td>$valor2</td>";
                        }
                ?>
                <td>-</td>
            </tr>
            <tr>
                <td>FORNECEDOR</td>
                <?php
                    // Carregar Fornecedor da ferramenta 1
                    echo "<td>$forn1</td>";
                    // Carregar Fornecedor da ferramenta 2
                    echo "<td>$forn2</td>";
                ?>
                <td>-</td>                
            </tr>

            <tr>
                <th colspan="4">DADOS DE CORTE</th>
            </tr>
            
            <tr>
                <td>VELOCIDADE DE CORTE [m/min]</td>
                <?php
                // Verificar Velocidade de Corte
                    vlr1Maior($caracFerr1[4], $caracFerr2[4], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>AVANÇO [mm/min]</td>
                <?php
                    vlr1Maior($caracFerr1[5], $caracFerr2[5], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>COMPRIMENTO USINADO [mm]</td>
                <?php
                    vlr1Maior($caracFerr1[6], $caracFerr2[6], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>TEMPO DE USINAGEM [minutos]</td>
                <?php
                    // Carregar Tempo de Usinagem da ferramenta 1
                    if (!empty($caracFerr1[5]) && !empty($caracFerr1[6]))
                        {
                            $valor1 = round($caracFerr1[6]/$caracFerr1[5], 2);
                        }
                    else
                        {
                            $valor1 = '-';
                        }
                    // Carregar Tempo de Usinagem da ferramenta 2
                    if (!empty($caracFerr2[5]) && !empty($caracFerr2[6]))
                        {
                            $valor2 = round($caracFerr2[6]/$caracFerr2[5], 2);
                        }
                    else
                        {
                            $valor2 = '-';
                        }
                    vlr1Menor($valor1, $valor2, $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <th colspan="4">INFORMAÇÕES DE CUSTO</th>
            </tr>

            <tr>
                <td>CUSTO PASTILHAS NOVAS [R$]</td>
                <?php
                    vlr1Menor($caracFerr1[7], $caracFerr2[7], $forn1, $forn2, 1);
                ?>
            </tr>

            <tr>
                <td>QTDE DE ARESTAS</td>
                <?php
                    vlr1Maior($caracFerr1[8], $caracFerr2[8], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>QTDE DE PASTILHAS/FERRAMENTA</td>
                <?php
                    vlr1Maior($caracFerr1[9], $caracFerr2[9], $forn1, $forn2);
                ?>
            </tr>
            
            <tr>
                <td>VIDA ÚTIL [pçs]</td>
                <?php
                    vlr1Maior($caracFerr1[10], $caracFerr2[10], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>CUSTO PASTILHAS ALISADORA [R$]</td>
                <?php
                    vlr1Menor($caracFerr1[11], $caracFerr2[11], $forn1, $forn2, 1);
                ?>
            </tr>

            <tr>
                <td>QTDE DE ARESTAS PAST. ALISADORA</td>
                <?php
                    vlr1Maior($caracFerr1[12], $caracFerr2[12], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>QTDE DE PAST. ALISADORA/FERRAM.</td>
                <?php
                    vlr1Maior($caracFerr1[13], $caracFerr2[13], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>VIDA ÚTIL PAST. ALISADORA [pçs]</td>
                <?php
                    vlr1Maior($caracFerr1[14], $caracFerr2[14], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>CUSTO DE FERR./PÇ [R$/pç]</td>
                <?php
                    // Carregar Custo por ferramenta da ferramenta 1
                    if (!empty($caracFerr1[7]) && !empty($caracFerr1[8])  && !empty($caracFerr1[9]) && !empty($caracFerr1[10]))
                        {
                            $custoFerr1 = ($caracFerr1[7] * $caracFerr1[9]) / ($caracFerr1[8] * $caracFerr1[10]);
                            if (!empty($caracFerr1[11]) && !empty($caracFerr1[12]) && !empty($caracFerr1[13]) && !empty($caracFerr1[14]))
                            {
                                $vlraux = ($caracFerr1[11] * $caracFerr1[13]) / ($caracFerr1[12] * $caracFerr1[14]);
                                $custoFerr1 = $custoFerr1 + $vlraux;
                            }
                        }
                    else
                        {
                            $custoFerr1 = '-';
                        }
                    // Carregar Custo por ferramenta da ferramenta 2
                    if (!empty($caracFerr2[7]) && !empty($caracFerr2[8])  && !empty($caracFerr2[9]) && !empty($caracFerr2[10]))
                        {
                            $custoFerr2 = ($caracFerr2[7] * $caracFerr2[9]) / ($caracFerr2[8] * $caracFerr2[10]);
                            if (!empty($caracFerr2[11]) && !empty($caracFerr2[12]) && !empty($caracFerr2[13]) && !empty($caracFerr2[14]))
                            {
                                $vlraux = ($caracFerr2[11] * $caracFerr2[13]) / ($caracFerr2[12] * $caracFerr2[14]);
                                $custoFerr2 = $custoFerr2 + $vlraux;
                            }
                        }
                    else
                        {
                            $custoFerr2 = '-';
                        }
                    vlr1Menor($custoFerr1, $custoFerr2, $forn1, $forn2, 1);
                ?>
            </tr>

            <tr>
                <td>PREVISÃO DE PROD.ANUAL [pçs]</td>
                <?php
                    vlr1Maior($caracFerr1[15], $caracFerr2[15], $forn1, $forn2);
                ?>
            </tr>

            <tr>
                <td>CUSTO DE FERRAM./ANO [R$]</td>
                <?php
                    // Carregar Custo por ferramenta por ano da ferramenta 1
                    if (!empty($caracFerr1[7]) && !empty($custoFerr1) && !empty($caracFerr1[15]))
                    {
                        $custAnoFerr1 = $custoFerr1 * $caracFerr1[15];
                    }
                    else
                    {
                        $custAnoFerr1 = '-';
                    }
                    // Carregar Custo por ferramenta por ano da ferramenta 2
                    if (!empty($caracFerr2[7]) && !empty($custoFerr2) && !empty($caracFerr2[15]))
                    {
                        $custAnoFerr2 = $custoFerr2 * $caracFerr2[15];
                    }
                    else
                    {
                        $custAnoFerr2 = '-';
                    }
                    vlr1Menor($custAnoFerr1, $custAnoFerr2, $forn1, $forn2, 1);
                ?>
            </tr>

            <tr>
                <td>RED. CUSTO ANUAL [R$]</td>
                <td class="blue">-</td>
                <?php
                    if ($custAnoFerr1 != '-' && $custAnoFerr2 != '-')
                    {
                        $redAnoVlr = $custAnoFerr1 - $custAnoFerr2;
                        $redAno = round($redAnoVlr, 2);
                        $redAno = str_replace('.', ',', $redAno);
                        echo "<td class='blue'>R$ $redAno</td>";
                    }
                    else{
                        $redAnoVlr = '-';
                        echo "<td class='blue'>-</td>";
                    }
                ?>
                <td class="blue">-</td>
            </tr>

            <tr>
                <td>RED. CUSTO/PÇ ANUAL [%]</td>
                <td class="blue">-</td>
                <?php
                    if ($redAnoVlr != '-' && $custAnoFerr1 !=  '-'){
                        $porcAno = round($redAnoVlr / $custAnoFerr1, 2) * 100;
                        echo "<td class='blue'>$porcAno %</td>";
                    }
                    else{
                        echo "<td class='blue'>-</td>";
                    }
                ?>
                <td class="blue">-</td>
            </tr>

            <tr class="amarelo">
                <td>PREVISÃO DE CONSUMO MENSAL</td>
                <?php
                // Previsão de consumo Ferramenta 1
                    if (!empty($caracFerr1[8]) && !empty($caracFerr1[9]) && !empty($caracFerr1[10]) && !empty($caracFerr1[15]))
                    {
                        $valor1 = (($caracFerr1[15] / 12)/($caracFerr1[10] * $caracFerr1[8]) * $caracFerr1[9]);
                        $valor1 = ceil($valor1);
                    }
                    else
                    {
                        $valor1 = '-';
                    }
                // Previsão de consumo Ferramenta 2
                    if (!empty($caracFerr2[8]) && !empty($caracFerr2[9]) && !empty($caracFerr2[10]) && !empty($caracFerr2[15]))
                    {
                        $valor2 = (($caracFerr2[15] / 12)/($caracFerr2[10] * $caracFerr2[8]) * $caracFerr2[9]);
                        $valor2 = ceil($valor2);
                    }
                    else
                    {
                        $valor2 = '-';
                    }
                    vlr1Menor($valor1, $valor2, $forn1, $forn2);
                ?>
            </tr>
        </table>
    </body>
</html>