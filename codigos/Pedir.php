<?php 
    include('BancoDeDados.php');
    include('ChecarLogin.php');

    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/pedir.css" />
		<title>Categoria</title>
	</head>
    
	<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li><a href="index.php">Página Principal</a></li>
                    <?php if(isset($_SESSION['id_restaurante'])) {?>
                    <li><a href="Clientes/Categorias.php">Categorias</a></li>
                    <?php } ?>
                    <li><a href="Comidas.php">Comidas</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <?php
        if(isset($_GET['id']))
        {
            $id_comida = $_GET['id'];

            $id_restaurante = $_GET['id_restaurante'];

            $sql_nome = "SELECT nome_restaurante, taxa_entrega FROM tabela_restaurantes WHERE id=$id_restaurante";
          
            $res_nome = mysqli_query($conn, $sql_nome);

            $count_nome = mysqli_num_rows($res_nome);

            $linhas_nome = mysqli_fetch_assoc($res_nome);

            $nome_restaurante = $linhas_nome['nome_restaurante'];

            $taxa_entrega = $linhas_nome['taxa_entrega'];

            $sql = "SELECT * FROM tabela_comida WHERE id=$id_comida";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                $linhas = mysqli_fetch_assoc($res);
                $titulo = $linhas['titulo'];
                $preco = $linhas['preco'];
                $nome_imagem = $linhas['nome_imagem'];              
            }

            else
            {
                header('location: Comidas.php');
            }
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-black">Preencha para concluir o seu pedido</h2>

            <form action="#" class="order" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <b><legend class="text-white">Comida Selecionada</legend></b>

                    <div class="food-menu-img text-white">
                        <img src="../imagens/comidas/<?php echo $nome_imagem; ?>" alt=<?php echo $titulo; ?> class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $titulo; ?></h3>
                        <p class="preco">R$: <?php echo number_format($preco, 2, '.', ','); ?></p>

                        <div class="order-label">Quantidade</div>
                        <input type="number" name="quantidade" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                <b><legend class="text-white">Detalhe da Entrega</legend></b>

                    <div class="order-label">Nome Completo</div>
                    <input type="text" name="nome_completo" placeholder="Insira o nome para receber" class="input-responsive" required>

                    <div class="order-label">Telefone</div>
                    <input type="tel" name="telefone" placeholder="Insira seu telefone" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Insira seu e-mail" class="input-responsive" required>

                    <div class="order-label">Endereço</div>
                    <textarea name="endereco" rows="10" placeholder="Insira seu endereço" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Concluir" class="btn btn-primary">

                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
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
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="text-center">
            <img src="../imagens/NozapBranco.png" alt="" class="footer_img"/> 
			<span>© Copyright 2020 - ZapFood</span> <br />
            <span>Todos os direitos reservados</span>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>


<?php 
    
    if(isset($_POST['submit'])) // Ele verifica se o botão foi clicado ou não
    {
        date_default_timezone_set('America/Sao_Paulo');
        //$date = date_create(time(), timezone_open('America/Sao_Paulo'));
        //$data_ordem = date_format($date, 'd/m/Y H:i:s');
        $data_ordem = date("Y-m-d H:i:s", time());
        $quantidade = $_POST['quantidade'];
        $preco = floatval(str_replace(',','.',$preco)); 
        $total = floatval(str_replace(',','.',$preco * $quantidade));   
        $bairro =  $_SESSION['bairro'];
        $id_cliente;

        if(isset($_SESSION['id']))
        {
            $id_cliente = $_SESSION['id'];
        }

        if(isset($_SESSION['id_restaurante']))
        {
            $id_cliente = $_SESSION['id_restaurante'];
        }

        if(!isset($_SESSION['carrinho']))
        {
            $pedido = array('id_restaurante' => $_GET['id_restaurante'],'nome_comida' => $titulo,
                            'quantidade' => $_POST['quantidade'], 'preco' => $preco,
                            'total' => $total,
                            'data_ordem' => $data_ordem,  
                            'estado' => "Em Análise", 
                            'nome_completo' => $_POST['nome_completo'],
                            'telefone' => $_POST['telefone'],
                            'email' => $_POST['email'],
                            'endereco' => $_POST['endereco'], 
                            'bairro' => $bairro,
                            'id_cliente' => $id_cliente);

            $taxa_pedido = array('id_restaurante' => $_GET['id_restaurante'],
                                 'taxa_pedido' => $taxa_entrega);

            $_SESSION['taxas'][0] =  $taxa_pedido;

            $_SESSION['carrinho'][0] = $pedido;
            $_SESSION['contador'] = 0;
        }

        else
        {       
            $_SESSION['contador']++;
            $pedido = array('id_restaurante' => $_GET['id_restaurante'],'nome_comida' => $titulo,
                            'quantidade' => $_POST['quantidade'], 'preco' => $preco,
                            'total' => $total,
                            'data_ordem' => $data_ordem, 
                            'estado' => "Em Análise", 
                            'nome_completo' => $_POST['nome_completo'],
                            'telefone' => $_POST['telefone'],
                            'email' => $_POST['email'],
                            'endereco' => $_POST['endereco'], 
                            'bairro' => $bairro,
                            'id_cliente' => $id_cliente);

            $taxa_pedido = array('id_restaurante' => $_GET['id_restaurante'],
                                 'taxa_pedido' => $taxa_entrega);

            $contador_loop = $_SESSION['contador'];
            $adiciona = true;

            echo "vaiu até aqui";

            for($i = 0; $i < $contador_loop; $i++)
            {
                if($_SESSION['taxas'][$i] == $taxa_pedido)
                {
                    $adiciona = false;
                    echo "não vai add";
                }
            }

            if($adiciona == true)
            {
                $_SESSION['taxas']['contador'] = $taxa_pedido;
                echo "vai add";
            }
                            
            $_SESSION['carrinho']['contador'] = $pedido;
        }

        
        /*
        $id_restaurante = $_GET['id_restaurante'];
        $quantidade = $_POST['quantidade'];
        $preco = floatval(str_replace(',','.',$preco));
        $total = floatval(str_replace(',','.',$preco * $quantidade));  
        date_default_timezone_set('America/Sao_Paulo');
        $data_ordem = date("d/m/Y H:i:sa", time()); 
        $estado = "Em Analise"; //Em Analise, Preparando, Entregando, Concluido

        $nome_completo = $_POST['nome_completo'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $endereco = $_POST['endereco'];
        
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
                            id_restaurante='$id_restaurante'";

        echo $sql;

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            $_SESSION['add'] = "Categoria adicionada com sucesso";

            header("location:".SITE_URL.'codigos/Clientes/Pedidos.php');
        }
        */

        header("location:".SITE_URL.'codigos/Clientes/Restaurante.php?nome_restaurante='.$nome_restaurante.'');
    }
?>