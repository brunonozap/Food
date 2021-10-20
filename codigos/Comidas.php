<?php 
    if(!isset($_SESSION))
    { 
        session_start();
    }

    ob_start();

    include('BancoDeDados.php');
    include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <!-- Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/comidas.css" />
		<title>No Zap Food</title>
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
                    <li>
                        <a href="index.php">Página Principal</a>
                    </li>
                    <li>
                        <a href="../codigos/Clientes/Categorias.php">Categorias</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="" method="POST">
                <input type="search" name="buscar_comida" placeholder="Buscar por comida">
                <input type="submit" name="enviar" value="Buscar" class="btn btn-primary">
            </form>

        </div>
    </section>

    <!-- fOOD sEARCH Section Ends Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cardápio</h2>
            <?php include('ExibicaoComidas.php'); ?>        
            <div class="clearfix"></div>
        </div>
    </section>

  <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">

            <ul>
                <img src="../imagens/NozapBranco.png" style="width:15%"/>

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

            <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>
        </div>
    </section>

    </body>
</html>

<?php 
    if((isset($_POST['enviar'])))
    {
        $nome_comida = $_POST['buscar_comida'];

        if($nome_comida != "")
        {
            header('location: Comidas.php?nome_comida='.$nome_comida.'');
        }

        else
        {
            header('location: Comidas.php');
        }
    }
?>