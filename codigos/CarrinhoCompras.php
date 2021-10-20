<?php  
    session_start(); 

    ob_start();

    include('BancoDeDados.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho Compras</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/carrinhocompras.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <div class="container-geral">
        <div class="add-restaurante-Fundo">
            <nav class="nav-bar">
                <div class="logo">
                    <a href="#" title="Logo">
                        <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                </div>

                <div class="cabeca">
                    <ul id="links">
                        <li>
                            <a href="index.php">Página Principal</a>
                        </li>
                        <li>
                            <a href="ListaRestaurantes.php">Restaurantes</a>
                        </li>
                        <li>
                            <a href="Comidas.php">Comidas</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Navbar Section Ends Here -->

    <h1>Carrinho de Compras</h1>

    <?php 
        /*if($_GET['id_deletar'])
        {
            $id_deletar = $_GET['id_deletar'];
            echo var_dump($_SESSION['carrinho'][$id_deletar]);
        }*/
    ?>

    <div id = "tabela">
        <table class = "table-full">
            <tr class="borda-superior">
                <th >ID</th>
                <th >Nome Comida</th>
                <th >Quantidade</th>
                <th >Preço</th>
                <th >Total</th>
                <th >Ação</th>
            </tr>

            <?php
               
               if(isset($_GET['id_deletar']))
               {
                   $id_deletar = $_GET['id_deletar'];
                   unset($_SESSION['carrinho'][$id_deletar]);
                   $_SESSION["carrinho"] = array_values($_SESSION["carrinho"]);

                   if(count($_SESSION['carrinho']) < 1)
                   {
                       unset($_SESSION['carrinho']);
                   }
               }

               if(isset($_SESSION['carrinho']))
               {                   
                    $contador = 0;
                    $taxas_inclusas = false;

                    foreach($_SESSION['carrinho'] as $key => $value)
                    {
                        //$teste = $_SESSION['carrinho']['nome_comida'.$contador];
                        //echo var_dump($value['nome_comida']);
                        //$value = var_dump($value);    
                            
                        $id_restaurante = $value['id_restaurante']; 
                        $titulo = $value['nome_comida'];
                        $quantidade = $value['quantidade'];
                        $preco = $value['preco'];
                        $total = $value['total'];          
                        $data_ordem = $value['data_ordem'];
                        $estado = $value['estado']; //Em Analise, Preparando, Entregando, Concluido    
                        $nome_completo = $value['nome_completo'];
                        $telefone = $value['telefone'];
                        $email = $value['email'];
                        $endereco = $value['endereco'];
                        $data_pedido = date("d/m/Y H:m:s");
                        
                        if($taxas_inclusas == false)
                        {
                            foreach($_SESSION['taxas'] as $key => $taxas)
                            {
                                $total += $taxas['taxa_pedido'];
                            }    
                            
                            $taxas_inclusas = true;
                        }

                        ?>

                        <tr class="nomes-abaixo">
                            <td><?php echo $id_restaurante; ?></td>
                            <td><?php echo $titulo; ?></td>
                            <td><?php echo $quantidade; ?></td>
                            <td><?php echo $preco; ?></td>
                            <td><?php echo $total; ?></td>                               
                            <td>                            
                                <p></p>
                                <p class="espaco_botoes"><a class="Deletar_Pedido" href = "CarrinhoCompras.php?id_deletar=<?php echo $contador; ?>" >Deletar</a></p>                      
                            </td>
                        </tr>

                        <?php
                        $contador++;
                    }
                        
                }
                
               else
               {
                  ?>
                    <tr>
                        <td colspan="6">
                            <div class="error">Sem Item Adicionado.</div>
                        </td>
                    </tr>
                    <?php
               }               
            ?>
        </table>
    </div> <!-- tabela -->

    <?php if(isset($_SESSION['carrinho'])) {?>
        <form action="#" method="POST" class="centralizar">
            <input type = "submit" name = "finalizar_offline" value = "Pagar na Entrega" class = "botao-Finalizar">
            <input type = "submit" name = "finalizar_online" value = "Pagar Agora" class = "botao-Finalizar">
        </form>
    <?php } ?> 

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>         
                    <img class="img-left" src="../imagens/NozapBranco.png" style="width:15%"/>    
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
            <span class = "texto"> © Copyright 2020 - ZapFood - Todos os direitos reservados! </span>
        </div>

        
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <!--<div class="footer-rodape-baixo"><br>
        <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>
    </div> --> <!-- Footer-rodapé-Baixo -->
    <!-- footer Section Ends Here -->

</body>
</html>

<?php 
    if(isset($_POST['finalizar_offline'])) // Ele verifica se o botão foi clicado ou não
    {
        $contador = 0;

        if(isset($_SESSION['carrinho']))
        {

            foreach($_SESSION['carrinho'] as $key => $value)
            {
                //$teste = $_SESSION['carrinho']['nome_comida'.$contador];
                //echo var_dump($value['nome_comida']);
                //$value = var_dump($value);    

                
                $id_restaurante = $value['id_restaurante']; 
                $titulo = $value['nome_comida'];
                $quantidade = $value['quantidade'];
                $preco = $value['preco'];
                $total = $value['total'];          
                $data_ordem = $value['data_ordem'];
                $estado = $value['estado']; //Em Analise, Preparando, Entregando, Concluido    
                $nome_completo = $value['nome_completo'];
                $telefone = $value['telefone'];
                $email = $value['email'];
                $endereco = $value['endereco'];
                $data_pedido = date("d/m/Y H:m:s");
                $pago = false;
                $bairro = $value['bairro'];
                $id_cliente = $value['id_cliente'];

                if(isset($_SESSION['taxas']))
                {
                    foreach($_SESSION['taxas'] as $key => $taxas)
                    {
                        $total += $taxas['taxa_pedido'];
                    }

                    unset($_SESSION['taxas']);
                }
                
                //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
                $sql = "INSERT INTO tabela_pedidos SET
                                    comida='$titulo',
                                    preco='$preco',
                                    quantidade='$quantidade',
                                    total='$total',
                                    data_ordem='$data_ordem',
                                    estado='$estado',
                                    nome_cliente='$nome_completo',
                                    contato_cliente='$telefone',
                                    endereco_cliente='$endereco',
                                    email_cliente='$email',
                                    id_restaurante='$id_restaurante',
                                    Pago='$pago',
                                    bairro='$bairro',
                                    id_cliente='$id_cliente'";

                //echo $sql;

                $res = mysqli_query($conn, $sql);       
            }



            $id_usuario = $_SESSION['id'];
            $sql2 = "UPDATE tabela_usuarios SET ultimo_pedido='$data_ordem' WHERE id='$id_usuario'";
            $res2 = mysqli_query($conn, $sql2);
            //echo $sql2;

            unset($_SESSION['contador']);
            unset($_SESSION['carrinho']);

            header('location: PedidosCliente.php');
        }
    }

    if(isset($_POST['finalizar_online'])) // Ele verifica se o botão foi clicado ou não
    {
        header('location: PagamentoOnline.php');
    }
?>