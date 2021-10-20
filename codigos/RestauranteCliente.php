<?php 
    if(!isset($_SESSION))
    { 
        session_start();
    }

    include('BancoDeDados.php');
    include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/styles2.css" />
		<title>Zap Foods</title>
	</head>
    <?php 
        if(isset($_SESSION['carrinho'])) 
        { 
            foreach($_SESSION['carrinho'] as $key => $value)
            {
                //echo '<p>NOME_COMIDA: '.$value['nome_comida'].' | QUANTIDADE: '.$value['quantidade'].'</p>';
            }

            //echo var_dump($_SESSION['carrinho']); 
        }

        //$bairro =  $_SESSION['bairro'];
        //echo $bairro;

    ?>
    <?php if(!isset($_GET['nome_restaurante']) && isset($_GET['id'])) $_GET['nome_restaurante'] = $_GET['id']; ?>
	<body>
        <section class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                </div>

                <div class="menu text-right">
                    <ul class = "text_black">
                        <li>
                            <a href="index.php">Página Principal</a> 
                        </li>
                        |
                        <li>
                            <a href="CategoriasCliente.php">Categorias</a> 
                        </li>
                        |
                        <?php if(isset($_SESSION['carrinho'])) {?>
                        <li>
                            <a href="CarrinhoCompras.php">Carrinho de Compras</a> 
                        </li>
                        |
                        <li>
                            <a href="PagamentoOnline.php">Pagamento Online</a> 
                        </li>
                        |
                        <?php } ?>
                        <!--<li>
                            <a href="CategoriasCliente.php">Categorias</a> 
                        </li> 
                        |        -->
                        <li>
                            <a href="Logout.php">Sair</a>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </section>
        <!-- Navbar Section Ends Here -->

        <!-- fOOD sEARCH Section Ends Here -->
        <section class="food-menu">
            <div class="container">
                <h2 class="text-center">Cardápio</h2>
                <?php include('RestauranteParcial.php'); ?>        
                <div class="clearfix"></div>
            </div>
        </section>

        <div class="footer">
            <img src="../imagens/VerdeFood.png" alt="" style="width:15%;"/>
            <span>© Copyright 2020 - ZapFood <br />Todos os direitos reservados</span>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['finalizar'])) // Ele verifica se o botão foi clicado ou não
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
                                    bairro='$bairro'";

                //echo $sql;

                $res = mysqli_query($conn, $sql);       
            }

            $id_usuario = $_SESSION['id'];
            $sql2 = "UPDATE tabela_usuarios SET ultimo_pedido='$data_ordem' WHERE id='$id_usuario'";
            $res2 = mysqli_query($conn, $sql2);
            //echo $sql2;

            unset($_SESSION['contador']);
            unset($_SESSION['carrinho']);
        }
    }
?>