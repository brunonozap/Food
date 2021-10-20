<h3>Comidas</h3>

    <!--<button class="botaoesquerda" onclick="plusDivs(-1)" >&#10094;</button>
    <button class="botaodireita" onclick="plusDivs(1)">&#10095;</button> -->

    <?php
        $nome_comida;
        $sql;

        if(isset($_GET['nome_comida']))
        {
            $nome_comida = $_GET['nome_comida'];

            $nome_comida_minusculo = strtolower($nome_comida);

            $sql0 = "SELECT id FROM tabela_categoria WHERE titulo = '$nome_comida' OR titulo = '$nome_comida_minusculo'";

            $res0 = mysqli_query($conn, $sql0);

            $tamanho_linhas = mysqli_num_rows($res0);

            $identificador = -1;

            if($tamanho_linhas > 0) //checar o número das linhas 
            {
                //temos dados no banco de dados
                while($linhas = mysqli_fetch_assoc($res0))
                {
                    $identificador = $linhas['id'];
                }
            }

            $sql = "SELECT * FROM tabela_comida WHERE id_categoria = '$identificador'";
        }

        else
        {
            $sql = "SELECT * FROM tabela_comida";
        }

        $res = mysqli_query($conn, $sql); //Executar a Query
     

        if($res == true) //Se a query foi executada
        {
            //Conta as linhas para verificar se há dados ou não na lista
            $tamanho_linhas = mysqli_num_rows($res);

            if($tamanho_linhas > 0) //checar o número das linhas 
            {
                //temos dados no banco de dados
                while($linhas = mysqli_fetch_assoc($res))
                {
                    //pegar todos os dados em loop e pegar dados individuais a cada iteração

                    $id = $linhas['id'];
                    $id_restaurante = $linhas['id_restaurante'];
                    $titulo = $linhas['titulo'];
                    $preco = $linhas['preco'];
                    $nome_imagem = $linhas['nome_imagem'];
                    $descricao = $linhas['descricao'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="../imagens/comidas/<?php echo $nome_imagem; ?>" width=80 height=80>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $titulo; ?></h4>
                            <p class="food-price">R$: <?php echo number_format($preco, 2, '.', ','); ?></p>
                            <p class="food-detail">
                                <?php echo $descricao; ?>
                            </p>
                            <br>

                            <a href="Pedir.php?id=<?php echo $id; ?>&id_restaurante=<?php echo $id_restaurante;?>" 
                                    class="btn btn-primary">Pedir</a>
                        </div>
                    </div>
                <?php 
                } 
            }
        }?>
