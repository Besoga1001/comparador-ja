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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="records.css">
    <link rel="stylesheet" href="modal.css">
    <link rel="shortcut icon" href="favicon-16x16.png" type="image/x-icon">
    <script src="main.js" defer></script>
    <link rel="stylesheet" href="">
    <title>Ferramentas Troy</title>
</head>
<body>
    <header>
        <h1 class="header-title">Cadastro de Ferramentas</h1>
    </header>
    <main>
        <button type="button" class="button blue" id="cadastrarCliente">Cadastrar Ferramentas</button>
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
                <tr>
                    <td>1</td>
                    <td>FE33.0613198</td>
                    <td>WNMG080408-SWT515</td>
                    <td>TUNGALOY</td>
                    <td>
                        <button type="button" class="button green">Editar</button>
                        <button type="button" class="button red">Excluir</button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Sem Código WHB</td>
                    <td>WNMG080408-SW MC5015</td>
                    <td>TROY</td>
                    <td>
                        <button type="button" class="button green">Editar</button>
                        <button type="button" class="button red">Excluir</button>
                    </td>
                </tr>
               
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

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- Botão para acessar a tela do cadastro -->
        <form method='post' action='index.php'>
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