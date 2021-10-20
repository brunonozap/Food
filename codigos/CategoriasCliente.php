<?php 
include('BancoDeDados.php');


ob_start();

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/cliente_categoria.css">  
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
                    </li> |
                    
                    <li>
                        <a href="ListaRestaurantes.php">Restaurantes</a>
                    </li> |
                    
                    <li>
                        <a href="Comidas.php">Comidas</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Encontre Seu Tipo de Comida</h2>

                <?php 
                    $sql = "SELECT * FROM tabela_categoria";
                    $res = mysqli_query($conn, $sql); //Executar a Query

                    if($res == true)
                    {
                        $tamanho_linhas = mysqli_num_rows($res);

                        while($linhas = mysqli_fetch_assoc($res))
                        {          
                            $titulo = $linhas['titulo'];
                            $nome_imagem = $linhas['nome_imagem'];

                            ?>
                                <a href=" CategoriaSelecionada.php?categoria=<?php echo $titulo ?>">
                                    <div class="box-3 float-container">
                                        <img src="../imagens/<?php echo $nome_imagem ?>" alt="Pizza" class="img-responsive img-curve">
                                        <h3 class="float-text text-white"><?php echo $titulo ?></h3>
                                    </div>
                                </a>
                            <?php
                        }
                    }
                ?>

                <!-- <a href="../Clientes/CategoriaSelecionada.php?categoria=Pizza">
					<div class="box-3 float-container">
						<img src="../../imagens/pizza.jpg" alt="Pizza" class="img-responsive img-curve">
						<h3 class="float-text text-white">Pizzas</h3>
					</div>
				</a>

				<a href="../Clientes/CategoriaSelecionada.php?categoria=Hamburguer">
					<div class="box-3 float-container">
						<img src="../../imagens/burger.jpg" alt="Burguer" class="img-responsive img-curve">
						<h3 class="float-text text-white">Hambúrgueres</h3>
					</div>
				</a>

				<a href="../Clientes/CategoriaSelecionada.php?categoria=Hamburguer">
					<div class="box-3 float-container">
						<img src="../../imagens/comida4.jpg" alt="momo" class="img-responsive img-curve">
						<h3 class="float-text text-white">Marcarrões</h3>
					</div>
				</a> -->
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">

        <div class="text-center">
            <!--<ul>
                <a href="#"> <img class="img-left" src="../../imagens/VerdeFood.png" style="width:15%"/></a>
            </ul> -->

            <ul>
                <li class="canto">
                    <a href="index.php"> <img class="img-left" src="../imagens/NozapBranco.png" style="width:15%"/></a>
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
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <div class="footer-rodape-baixo"><br>
        <!--<img src="../../imagens/VerdeFood.png" style="width:15%"/> -->
        <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>
    </div> <!-- Footer-rodapé-Baixo -->
    <!-- footer Section Ends Here -->

</body>
</html>