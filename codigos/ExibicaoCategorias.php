<h3>Categorias do ZapFood</h3>

    <!--<button class="botaoesquerda" onclick="plusDivs(-1)" >&#10094;</button>
    <button class="botaodireita" onclick="plusDivs(1)">&#10095;</button> -->

    <?php
        $nome_categoria = $_GET['categoria'];
        $sql = "SELECT id FROM tabela_categoria WHERE titulo = '$nome_categoria'";
        $res = mysqli_query($conn, $sql); //Executar a Query
        $res2;

        if($res == true)
        {
            //echo "executou res"; 
            $estaCategorizado = false;
            $identificador = -1;
            $tamanho_linhas = mysqli_num_rows($res);
            //echo $tamanho_linhas;

            while($linhas = mysqli_fetch_assoc($res))
            {          
                $id = $linhas['id'];
                $identificador = $id;
                $estaCategorizado = true;
                $sql2 = "SELECT * FROM tabela_comida WHERE id_categoria = '$id'";
                $res2 = mysqli_query($conn, $sql2); //Executar a Query
                //echo $sql2;                              
            }

            if($res2 == true) //Se a query foi executada
            {
                // "executou a query 2";

                //Conta as linhas para verificar se há dados ou não na lista
                $tamanho_linhas = mysqli_num_rows($res2);

                if($tamanho_linhas > 0) //checar o número das linhas 
                {
                    $contador_linhas = 0;

                    //echo "tamanho de linhas é maior que 0";

                    //temos dados no banco de dados
                    while($linhas = mysqli_fetch_assoc($res2))
                    {
                        //pegar todos os dados em loop e pegar dados individuais a cada iteração

                        $id = $linhas['id'];
                        $nome = $linhas['titulo'];
                        $preco = $linhas['preco'];
                        $descricao = $linhas['descricao'];
                        $nome_imagem = "../../imagens/".$linhas['nome_imagem'];

                        ?>
                        <a class="botao2" href="<?php echo SITE_URL; ?>codigos/Clientes/RestauranteCliente.php?id=<?php echo $id; ?>&nome_restaurante=<?php echo $nome; ?>" >
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="<?php echo $nome_imagem; ?>" width=80 height=80>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $nome; ?></h4>
                                    <p class="food-price">R$: <?php echo number_format($preco, 2, '.', ','); ?></p>
                                    <p class="food-detail">
                                        <?php echo $descricao; ?>
                                    </p>
                                    <br>

                                </div>
                            </div>
                        </a> 
                    <?php 
                    } 
                }
            }
        }

        //echo var_dump($res);
        //echo $res2;

       ?>


