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
		<link rel="stylesheet" href="../css/restaurantes.css" />
		<link rel="stylesheet" href="../css/carousel.css" />
		<title>Zap Food</title>
	</head>
	<body>
        <section class="navbar">
			<div class="container">
                
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                </div>

                <div class="menu text-right">
                    <ul>
                        <li>
                            <a href="index.php" class="links">Página Principal</a>
                        </li>
                        |
                        <li>
                            <a href="Clientes/Categorias.php" class="links">Categorias</a>
                        </li>
                        |
                        <li>
                            <a href="../codigos/Comidas.php" class="links">Comidas</a>
                        </li>
                    </ul>
                </div>

            </div>
        </section>
        <!-- Navbar Section Ends Here -->

        <!-- fOOD sEARCH Section Ends Here -->
        <section class="food-menu">
            <div class="container">
                <h2 class="text-center">Restaurantes</h2>
                <?php include('ExibicaoRestaurantes.php'); ?>        
                <div class="clearfix"></div>
            </div>
        </section>

        <div class="footer">
            <img src="../imagens/NozapBranco.png" alt="" style="width:15%;"/>
            <span>© Copyright 2020 - ZapFood Todos os direitos reservados</span>
        </div>
    </body>
</html>