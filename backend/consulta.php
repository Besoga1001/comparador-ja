<?php

include_once ("conexao.php");

#Gerar comando SQL para pesquisar a ferramenta
$sql = "SELECT * FROM tabpro ORDER BY TABPRO_Descricao";
# Gerar o comando de consulta linkando ao DB
$consulta = mysqli_query($conexao, $sql);
# Retornar o numero de linhas encontradas a partir da lista de "Consulta"
$registros = mysqli_num_rows($consulta);

# Se houver um item selecionado, pesquisar o item no SQL e coletar informações registradas.
# Coletar a variável "Ferramenta1" previamente selecionada
$itemPesquisado = isset($_GET["ferramenta1"])?$_GET["ferramenta1"]:"";
if(!empty($itemPesquisado)){
    # Gerar o comando no SQL
    $sql = "SELECT * FROM tabpro WHERE TABPRO_ID LIKE '$itemPesquisado'";
    # Conectar ao SQL e enviar o comando gerado
    $consultaFerramenta = mysqli_query($conexao, $sql);
    # Colocar em uma variável array a pesquisa feita
    $registroFerramenta = mysqli_fetch_array($consultaFerramenta);
}

# Lista de nomes das labels que aparecerão do lado das Inputs
$arrLabelCampo = ["ID", "Descrição", "Código WHB", "Fornecedor", "Velocidade de Corte [m/min]", "Velocidade de Avanço [mm/min]", "Comprimento Usinado[mm]", "Tempo de Usinagem [ minutos ]", "Custo Pastilha [R$]", "Qntd de Arestas", "Qntd de Pastilhas", "Vida Útil[pçs]", "Custo Pastilha (Alisadora) [R$]", "Qntd de arestas (Alisadora)", "Qntd de Pastilhas (Alisadora)", "Vida Util (Alisadora) [pçs]", "Custo de ferr. /pç [ R$ / pç ]", "Previsão de produção anual [pçs]", "Custo ferram. / ano [ R$ ]"];

# Lista de nomes dos InputBox que aparecerão do lado das Labels
$arrIDHtml = ["id", "desc", "codwhb", "forn", "velcorte", "avanco", "compusi", "tempusi", "custpastnova", "qtdarenova", "qtdpastnova", "vidautilnova", "custpastalisa", "qtdarealisa", "qtdpastalisa", "vidautilalisa", "custferrpç", "prevprod", "custferrano"];

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Comparador</title>
    </head>
    <body>
        <!-- Botão para acessar a tela de cadastro -->
        <form method='post' action='crud.php'>
            <button type='submit' name='cadastro'>Cadastro</button>
        </form>
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
                        if($id == $registroFerramenta[0]){
                            echo "<option value='$id' selected='selected'>$descricao</option>";
                        }
                        # Caso contrário apenas adiciona o item na lista sem o deixar selecionado
                        else{
                            echo "<option value='$id'>$descricao</option>";
                        }
                    }
                ?>
            </select>
            <!-- Botão de "Pesquisar" item selecionado na ListBox -->
            <input type="submit" value="Pesquisar"><br>
        </form>
        <!-- 
        ################################################ 
        ###############  CAMPOS DO SITE  ###############
        ################################################ 
        -->
        <form method="post" action="comparar.php">
            <?php
            # Looping For para inserir as labels e os input box a apartir da lista criada no cabeçalho da página
                if (!empty($registroFerramenta))
                {
                    # Carregar informações de "Descrição, Código WHB e Fornecedor
                    for ($i = 1; $i <= 4; $i++)
                    {
                        $label = $arrLabelCampo[$i];
                        $idHtml = $arrIDHtml[$i];
                        $valor = $registroFerramenta[$i];
                        if (!empty($valor))
                        {
                            echo "$label: <input type='text' id='$idHtml' value='$valor' readonly><br>";
                        }
                        else
                        {
                            echo "$label: <input type='text' id='$idHtml' value='N/A' readonly><br>"; 
                        }
                    }

                    # Alocar valor de Vel. Avanço Ferramenta 1 a variável
                    $velAvancoFerr1 = $registroFerramenta[5];
                    # Alocar Comp. Usinado ferramenta 1 a variável
                    $compUsiFerr1 = $registroFerramenta[6];

                    # Criar campo de label e inputbox
                    for ($i = 5; $i <= 6; $i++)
                    {
                        $label = $arrLabelCampo[$i];
                        $idHtml = $arrIDHtml[$i];
                        if (!empty($registroFerramenta[$i]))
                        {
                            $valor = $registroFerramenta[$i]; 
                            echo "$label: <input type='text' id='$idHtml' value='$valor' readonly>";

                        }
                        else
                        {
                            echo "$label: <input type='text' id='$idHtml' value='N/A' readonly>";
                        }
                    }

                    ### Tempo de Usinagem
                    # Criar label e inputbox para 
                    $label = $arrLabelCampo[7];
                    $idHtml = $arrIDHtml[7];

                    if (!empty($velAvancoFerr1) && !empty($compUsiFerr1))
                    {
                        # Calcular o tempo Usinado
                        $tempoUsi = $compUsiFerr1 / $velAvancoFerr1;
                        # Arredondar o tempo
                        $tempoUsi = round($tempoUsi, 2);
                        echo "$label: <input type='text' id='$idHtml' value='$tempoUsi' readonly><br>";
                    }
                    else
                    {
                        echo "$label: <input type='text' id='$idHtml' value='N/A' readonly><br>";
                    }

                    echo "<br>Nova: <br><br>";

                    ### Custo Pastilha Nova, Qntd. de arestas, QNtd. de pastilhas e vida útil
                    # Alocar valores as variáveis
                    $custPastNova = ($registroFerramenta[8-1]);
                    $qntdAresNova = ($registroFerramenta[9-1]);
                    $qntdPastNova = ($registroFerramenta[10-1]);
                    $vidaUtilNova = ($registroFerramenta[11-1]);

                    # Inserir Label e Input
                    for ($i = 8; $i <= 11; $i++)
                    {
                        $label = $arrLabelCampo[$i];
                        $idHtml = $arrIDHtml[$i];
                        if (!empty($registroFerramenta[$i-1]))
                        {
                            $valor = $registroFerramenta[$i-1];
                            echo "$label: <input type='text' id='$idHtml' value='$valor' readonly><br>";
                        }
                        else
                        {
                            echo "$label: <input type='text' id='$idHtml' value='N/A' readonly><br>";
                        }
                    }

                    echo "<br>Alisadora: <br><br>";

                    ### Custo Pastilha alisadora, Qntd. de arestas, Qntd. d pastihlas e vida útil
                    # Alocar valores as variáveis
                    $custPastAlis = ($registroFerramenta[12-1]);
                    $qntdAresAlis = ($registroFerramenta[13-1]);
                    $qntdPastAlis = ($registroFerramenta[14-1]);
                    $vidaUtilAlis = ($registroFerramenta[15-1]);

                    # Inserir Label e Input
                    for ($i = 12; $i <= 15; $i++)
                    {
                        $label = $arrLabelCampo[$i];
                        $idHtml = $arrIDHtml[$i];
                        if (!empty($registroFerramenta[$i-1]))
                        {
                            $valor = $registroFerramenta[$i-1];
                            echo "$label: <input type='text' id='$idHtml' value='$valor' readonly><br>";
                        }
                        else
                        {
                            echo "$label: <input type='text' id='$idHtml' value='N/A' readonly><br>";
                        }
                    }

                    echo "<br>";

                    ### Custo de Ferr. por PÇ
                    # Calculo do valor
                    if (!empty($custPastNova))
                    {
                        if (!empty($qntdAresAlis))
                        {
                            $valorCustFerr = (($custPastNova * $qntdPastNova) / ($qntdAresNova * $vidaUtilNova)) + (($custPastAlis * $qntdPastAlis) / ($qntdAresAlis * $vidaUtilAlis));
                        }
                        else
                        {
                            $valorCustFerr = (($custPastNova * $qntdPastNova) / ($qntdAresNova  * $vidaUtilNova));
                        }
                    }
                    else
                    {
                        $valorCustFerr = '';
                    }

                    # Inserir label e Input
                    $label = $arrLabelCampo[16];
                    $idHtml = $arrIDHtml[16];
                    
                    if (!empty($valorCustFerr))
                    {
                        $valorCustFerrArred = round($valorCustFerr, 2);
                        echo "$label: <input type='text' id='$idHtml' value='$valorCustFerrArred' readonly><br>";
                    }
                    else
                    {
                        echo "$label: <input type='text' id='$idHtml' value='N/A' readonly><br>";
                    }

                    ### Previsão de Produção Anual
                    # Inserir Label e Input
                    $label = $arrLabelCampo[17];
                    $idHtml = $arrIDHtml[17];
                    $valorProdAno = $registroFerramenta[15];

                    if(!empty($valorProdAno))
                    {
                        echo "$label: <input type='text' id='$idHtml' value='$valorProdAno' readonly><br>";
                    }
                    else
                    {
                        echo "$label: <input type='text' id='$idHtml' value='N/A' readonly><br>";
                    }

                    ### Custo ferramental por ano
                    # Calculo do valor
                    if (!empty($custPastNova))
                    {
                        $valorFerrAno = $valorProdAno * $valorCustFerr;
                    }
                    else
                    {
                        $valorFerrAno='';
                    }

                    # Inserir Label e Input
                    $label = $arrLabelCampo[18];
                    $idHtml = $arrIDHtml[18];
                    if(!empty($valorFerrAno))
                    {
                        $valorFerrAnoArred = round($valorFerrAno, 2);
                        echo "$label: <input type='text' id='$idHtml' value='$valorFerrAnoArred' readonly><br>";
                    }
                    else
                    {
                        echo "$label: <input type='text' id='$idHtml' value='N/A' readonly><br>"; 
                    }

                }
        ###### CASO NAO TENHA NENHUM ITEM SELECIONADO
                else
                {
                    for ($i = 1; $i <= 18; $i++)
                    {
                        $label = $arrLabelCampo[$i];
                        $idHtml = $arrIDHtml[$i];
                        echo "$label: <input type='text' id='$idHtml' value='Selecionar ferramenta' readonly><br>";
                    }
                }
            ?>
        </form>
        


        <br><br><br><br><br><br>
    </body>
</html>