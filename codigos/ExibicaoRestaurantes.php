

    <!--<button class="botaoesquerda" onclick="plusDivs(-1)" >&#10094;</button>
    <button class="botaodireita" onclick="plusDivs(1)">&#10095;</button> -->

    <?php
        $sql = "SELECT * FROM tabela_restaurantes WHERE id != 1";
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
                    $nome = $linhas['nome_restaurante'];
                    $nome_imagem = "../imagens/".$linhas['nome_imagem'];
                    $telefone = $linhas['telefone'];
                    $bairro = $linhas['bairro'];
                    $email = $linhas['email'];

                    ?>
                    <a class="botao2" href="RestauranteCliente.php?id=<?php echo $id; ?>&nome_restaurante=<?php echo $nome; ?>" >
                        <div class="food-menu-box" >

                            <div class="food-menu-img">
                                <img class="imagem_comida" src="<?php echo $nome_imagem; ?>" > <!-- class="imagem_comida"  width=100 height=100-->
                            </div>

                            <div class="food-menu-desc">
                                <p class="nome"><?php echo $nome; ?></p>
                                <p class="bairro"><?php echo $bairro; ?></p>
                                <p class="telefone"> <?php echo $telefone; ?> </p>
                                <p class="email"><?php echo $email; ?></p>
                                <br>

                            </div>
                        </div>
                    </a> 
                <?php 
                } 
            }
        }?>


