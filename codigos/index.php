<?php 
	session_start();

	ob_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/index.css" />
		<link rel="stylesheet" href="../css/carousel.css" />
		<title>NoZap Food</title>
	</head>
	<body>
		<section class="navbar">
			<div class="container">
                
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-logo">
                    </a>
                </div>

				<div class="menu text-right">
					<?php if(isset($_SESSION['nome_restaurante']) != null)
					{ $nome_restaurante = $_SESSION['nome_restaurante'];?>
					
					<ul>
						<li><a href="ListaRestaurantes.php" class="links"><b>Restaurantes</b></a></li> |
						<li><a href="PainelControle.php" class="links"><b><?php echo $nome_restaurante; ?></b></a></li>
					</ul>

					<?php } else if(isset($_SESSION['nome']) != null) { 
						    $nome_usuario = $_SESSION['nome']; ?>

					<ul>
						<li><a href="ListaRestaurantes.php" class="links"><b>Restaurantes</b></a></li> |
						<li><a href="PainelControle.php" class="links"><b><?php echo $nome_usuario; ?></b></a></li>
					</ul>

					<?php }else { ?>
					<ul>
						<li><a href="ListaRestaurantes.php" class="links"><b>Restaurantes</b></a></li> |
						<li><a href="Login.php" class="links"><b>Entrar</b></a></li>
					</ul>

					<?php } ?>
				</div> <!-- Header -->

			</div>
        </section>

		<!-- BG -->
		<section class="bg">
			<div class="content">

				<img class="logozap" width="300px;" height="80px;" src="../imagens/VerdeFood.png" alt="" class="logo"/>
				<h2>Nunca foi tão facil pedir lanche</h2>
				<p class="descubra">Descubra restaurantes perto de você</p>

				<section class = "busca_comida">
					<div class = "container">
						<form action="" method="POST">
							<input type="search" name="search" placeholder="Buscar por comida" required>
							<input type="submit" name="submit" value="Buscar" class="buscar">
						</form>
					</div>
				<section>

				<!--<div class="form">
					<div class="search">
						<img src="../images/search.svg" alt="" />
						<input type="text" placeholder="Buscar endereço e número" />
					</div> Div.search 
		
					<a href="../Clientes/Restaurante.php" class="buscar"> Buscar </a>
					
				</div> --> <!-- Div.form -->
				
				<div class="tags">
					<span>#pizza</span>
					<span>#lanche</span>
					<span>#comidabrasileira</span>
					<span>#pizza</span>
					<span>#lanche</span>
					<span>#comidabrasileira</span>
				</div> <!-- Div.tags -->

			</div> <!-- Div.content -->
		</section> <!-- Div.bg -->

		<section class="categories">
			
        	<div class="imagens">
                <a href="../codigos/Clientes/CategoriaSelecionada.php?categoria=Pizza">
					<div class="box-3 float-container">
						<img src="../imagens/principal1.png" alt="Pizza" class="img-responsive img-curve">
					</div>
				</a>

				<a href="../codigos/Clientes/CategoriaSelecionada.php?categoria=Hamburguer">
					<div class="box-3 float-container">
						<img src="../imagens/principal2.png" alt="Burguer" class="img-responsive img-curve">
					</div>
				</a>

				<a href="../codigos/Clientes/CategoriaSelecionada.php?categoria=Hamburguer">
					<div class="box-3 float-container">
						<img src="../imagens/principal3.png" alt="momo" class="img-responsive img-curve">
					</div>
				</a>
				<div class="clearfix"></div>

			</div>

		</section>
				
				<!--	<section class = "promocoes">
					<div class = "imagens">

					<a href="ListaRestaurantes.php">

						<div class = "caixas3 caixa-flutuante">
							<a href="ListaRestaurantes.php">
								<img src = "../imagens/principal1.png" class = "imagem imagem-curva">
							</a>
						</div>


					<div class = "caixas3 caixa-flutuante">
						<img src = "../imagens/principal2.png" class = "imagem imagem-curva">
					</div>


					<div class = "caixas3 caixa-flutuante">
						<img src = "../imagens/principal3.png" class = "imagem imagem-curva">
					</div>


					</div>
				</section> -->

			<p></p>
			
			<div class="banner">
				<p><img class = "background" src="" alt="" /></p>
				<p><img class = "background" src="" alt="" /></p>
				<p><img class = "background" src="" alt="" /></p>
			</div> <!-- Banner -->

			    
				<!-- <h3>Os melhores do ZapFood</h3> -->
			    
				<!--CAROUSEL-->

				<!-- <div class="carousel">
					<button class="botao">&#10094;</button>
					<button class="botao">&#10095;</button>
					<section id="carousel-informacoes">
				<div class="container-card">

				<img src="../imagens/mcdonald-logo.png" width=80 height=80><div class="linha"></div> <!-- Linha -->
				<!-- <div class="texto-card">
				<span class="empresa">Mcdonald's</span>
				<div class="infor-P">
				<path class="bolinha"> • </path>
				<span class="texto-descricao">
					Lanches
				</span> 
				</div> --> <!--Infor-P-->

				<!-- </div> --> <!-- Texto-card -->

				<!-- </div> --> <!--Container-Card-->

				<!-- <div class="container-card">
					<img src="../imagens/cocobambu-logo.png" width=80 height=80><div class="linha"></div> <!-- Linha -->
					<!--<div class="texto-card">
					<span class="empresa">Coco Bambu</span>
					<div class="infor-P">
					<path class="bolinha"> • </path>
					<span class="texto-descricao">
					Frutos do mar
					</span>
					</div> --> <!--Infor-P-->
					<!-- </div> --> <!-- Texto-card -->	
				<!-- </div> --> <!-- Container-card -->

				<!-- <div class="container-card">
					<img src="../imagens/chinabox-logo.png" width=80 height=80><div class="linha"></div> --> <!-- Linha -->
					<!-- <div class="texto-card">
					<span class="empresa">China In Box</span>
					<div class="infor-P">
					<path class="bolinha"> • </path>
					<span class="texto-descricao">
					Chinesa
					</span>
					</div> --> <!--Infor-P-->
					
					<!-- </div> --> <!-- Texto-card -->
					
					<!-- </div> --> <!-- Container-card -->

			
				<!-- <div class="container-card"> 
				<img src="../imagens/habibs-logo.png" width=80 height=80><div class="linha"></div> --><!-- Linha -->
				<!-- <div class="texto-card">
				<span class="empresa">Habib's</span>
				<div class="infor-P">
				<path class="bolinha"> • </path>
				<span class="texto-descricao">
				Lanches
				</span>
				</div> --> <!--Infor-P--> 

				<!-- </div> --> <!-- Texto-card -->

				<!-- </div> --><!-- Container-card --> 

			<!--<div class="container-card">
				<img src="../imagens/outback-logo.png" width=80 height=80><div class="linha"></div> --> <!-- Linha -->
				<!-- <div class="texto-card">
				<span class="empresa">Outback</span>
				<div class="infor-P">
				<path class="bolinha"> • </path>
				<span class="texto-descricao">
				Lanches
				</span>
				</div> --><!--Infor-P-->
				
				<!-- </div> --><!-- Texto-card -->
				
				<!-- </div> --> <!-- Container-card -->

							<!-- </section>
						</div> --><!--Carrousel-->

	
			<!-- <h3 class="conhecer-nos">Venha nos conhecer</h3>

				<a href="../codigos/Clientes/Categorias.php">
					<div class="box-3 float-container">
						<img src="../imagens/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

						<h3 class="float-text text-white">Pizza</h3>
					</div>
				</a>

				<a href="../codigos/Clientes/Categorias.php">
					<div class="box-3 float-container">
						<img src="../imagens/burger.jpg" alt="Burguer" class="img-responsive img-curve">

						<h3 class="float-text text-white">Hamburguer</h3>
					</div>
				</a>

				<a href="../codigos/Clientes/Categorias.php">
					<div class="box-3 float-container">
						<img src="../imagens/momo.jpg" alt="momo" class="img-responsive img-curve">

						<h3 class="float-text text-white">Momo</h3>
					</div>
				</a>

			<div id="rodape-geral"> -->	

			<!-- <section class="footer-rodape">

				<div class="nozap-coluna">
				<h4 class="nozapfood">Nozapfood</h4>
				<li class="sobre" href="">Sobre nós</li>
				<li class="contate-nos" href="">Fale conosco</li>
				</div>  Nozap-Coluna 


				<div class="parceiros-coluna">
				<h4 class="parcerias">Parceiros</h4>
				<a href="./Clientes/Restaurante.php" class="link-restaurante"><li class="restaurantes">Ver os restaurantes</li><a> 
				</div> 

				<div class="redes-coluna">
					<h4 class="redes-sociais">Redes sociais</h4>
					<div class="icones-sociais">
						<a href="https://www.facebook.com/nozapoficial" target="_blank"><img class="facebook" src="../imagens/facebook-icone.png" width="8%" height="8%"></a>
						<a href="https://nozap.net.br" target="_blank"><img class="whatsapp" src="../imagens/zap-icone.png" width="8%" height="8%"></a>
						<a href="https://www.youtube.com/channel/UCIe08W6Lb_7EJEilL6VavOg" target="_blank"><img class="youtube" src="../imagens/youtube-logo.png" width="8%" height="8%"></a>
						<a href="https://www.instagram.com/nozapoficial" target="_blank"><img class="instagram" src="../imagens/instagram-icone.png" width="8%" height="8%"></a>
					</div>  Icones-Sociais
				</div> 

				<div class="telefone-coluna">
				<h4 class="telefone">Telefone</h4>
				</div> 

			</section> -->

			<div class="footer-rodape-baixo"><br>
			<img src="../imagens/NozapBranco.png" style="width:15%"/>
			<span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>

			</div> <!-- Footer-rodapé-Baixo -->
			</div> <!-- Rodape-geral -->
			</body>
        </html>

		<?php
			if(isset($_POST['submit']))
			{
				$comida =  $_POST['search'];
				header("location: CategoriaSelecionada.php?categoria='$comida'");
			}
		?>

		<script type="text/javascript">

		var button = document.getElementsByClassName('botao');
		var div = document.getElementsByClassName('container-card');
		var l = 0;

		button[1].onclick = ()=>{
			l++;
			for (var i of div)
			{
				if (l==0) {i.style.left = "0px";}
				if (l==1) {i.style.left = "-740px";}
				if (l==2) {i.style.left = "-1480px";}
				if (l==3) {i.style.left = "-2220px";}
				if (l==4) {i.style.left = "-2960px";}
				if (l>4) {l=4;}
			} 
		}

		button[0].onclick = ()=>{
			l--;
			for (var i of div)
			{
				if (l==0) {i.style.left = "0px";}
				if (l==1) {i.style.left = "-740px";}
				if (l==2) {i.style.left = "-1480px";}
				if (l==3) {i.style.left = "-2220px";}
				if (l==4) {i.style.left = "-2960px";}
				if (l<0) {l=4;}
			} 
		}

		</script>
