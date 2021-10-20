
    <!--<button class="botaoesquerda" onclick="plusDivs(-1)" >&#10094;</button>
    <button class="botaodireita" onclick="plusDivs(1)">&#10095;</button> -->

    <?php
        if(isset($_GET['id']))
        {
            $id_restaurante = $_GET['id'];
            $_SESSION['restaurante_selecionado'] = $id_restaurante;
        }

        else
        {
            $id_restaurante = $_SESSION['restaurante_selecionado'];
        }

        $sql = "SELECT * FROM tabela_comida WHERE id_restaurante='$id_restaurante'";
        $res = mysqli_query($conn, $sql); //Executar a Query

        if($res == true) //Se a query foi executada
        {
            //Conta as linhas para verificar se há dados ou não na lista
            $tamanho_linhas = mysqli_num_rows($res);

            if($tamanho_linhas > 0) //checar o número das linhas 
            {
                $contador_linhas = 0;

                //temos dados no banco de dados
                while($linhas = mysqli_fetch_assoc($res))
                {
                    //pegar todos os dados em loop e pegar dados individuais a cada iteração

                    $id = $linhas['id'];
                    $titulo = $linhas['titulo'];
                    $descricao = $linhas['descricao'];
                    $preco = $linhas['preco'];
                    $nome_imagem = "../imagens/comidas/".$linhas['nome_imagem'];

                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="<?php echo $nome_imagem; ?>" width=100 height=100>
                        </div>

                        <div class="food-menu-desc">
                            <p class="food-price"><?php echo $titulo; ?></p>
                            <p class="food-detail">
                                <?php echo $descricao; ?>
                            </p>
                            <p class="food-price">
                                R$: <?php echo number_format($preco, 2, '.', ','); ?>
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


