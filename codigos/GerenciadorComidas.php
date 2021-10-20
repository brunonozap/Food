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
		<link rel="stylesheet" href="../css/gerenciador_comida.css" />
		<title>Administrativo</title>
	</head>
    
	<body>
		<section class = "navbar">
			<div class="container">				
				<div class="logo">
					<a href="../codigos/index.php" title="Logo">
						<img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
					</a>
				</div> 
				<!-- Logo -->

				<!-- HEADER -->
				<div class="header">
					<ul>
						<li><a href="">Entregador</a></li>
						<li><a href="">Restaurante</a></li>
						<li><a href="">Carreiras</a></li>
						<li><a href="PainelControle.php">Painel Controle</a></li>
						<li><a href="Logout.php">Sair</a></li>
					</ul>
				</div>				
			</div>
		</section>

					<h1>Página de Comidas</h1>
					<p></p>


				<?php
					if(isset($_SESSION['add']))
					{
						echo $_SESSION['add']; //Mostra mensagem de sessão
						unset($_SESSION['add']); //Remove mensagem de sessão
					}

					if(isset($_SESSION['delete']))
					{	
						echo $_SESSION['delete']; //Mostra mensagem de sessão
						unset($_SESSION['delete']); //Remove mensagem de sessão
					}

					if(isset($_SESSION['update']))
					{
						echo $_SESSION['update']; //Mostra mensagem de sessão
						unset($_SESSION['update']); //Remove mensagem de sessão
					}

					if(isset($_SESSION['user-not-found']))
					{
						echo $_SESSION['user-not-found']; //Mostra mensagem de sessão
						unset($_SESSION['user-not-found']); //Remove mensagem de sessão
					}

					if(isset($_SESSION['pwd-not-match']))
					{
						echo $_SESSION['pwd-not-match']; //Mostra mensagem de sessão
						unset($_SESSION['pwd-not-match']); //Remove mensagem de sessão
					}
					
					if(isset($_SESSION['change-pwd']))
					{
						echo $_SESSION['change-pwd']; //Mostra mensagem de sessão
						unset($_SESSION['change-pwd']); //Remove mensagem de sessão
					}

					if(isset($_SESSION['no-login-message']))
					{
						echo $_SESSION['no-login-message'];
						unset($_SESSION['no-login-message']);
					}

				?>

				<p></p>
	
				<table class = "table-full">
					<tr>
						<th div class="td">Numero Serial</th>
						<th div class="td">Titulo</th>
						<th div class="td">Nome Imagem</th>
						<th div class="td">Ações</th>
					</tr>

					<?php
						$sql = "SELECT * FROM tabela_comida";
						$res = mysqli_query($conn, $sql); //Executar a Query

						if($res == true) //Se a query foi executada
						{
							//Conta as linhas para verificar se há dados ou não na lista
							$tamanho_linhas = mysqli_num_rows($res);

							if($tamanho_linhas > 0) //checar o número das linhas 
							{
								//temos dados no banco de dados
								while($linhas = mysqli_fetch_assoc($res))
								{
									//pegar todos os dados em loop e pegar dados individuais a cada iteração

									$id = $linhas['id'];
									$titulo = $linhas['titulo'];
									$nome_imagem = $linhas['nome_imagem'];

									?>

									<tr>
										<td div class="td"><?php echo $id; ?></td>
										<td div class="td"><?php echo $titulo; ?></td>
										<td div class="td"><img src="../imagens/comidas/<?php echo $nome_imagem;?>" width="100px" height="100px"></td>
										<td>
											<p></p>
											<p><a href = "AtualizarCategoria.php?id=<?php echo $id; ?>" >Mudar</a></p>
											<p><a href = "DeletarCategoria.php?id=<?php echo $id; ?>&nome_imagem=<?php echo $nome_imagem; ?>" class = "btn-primary">Deletar</a></p>
										</td>
									</tr>

									<?php
								}
							}

							else
							{
								?>

									<tr>
										<td colspan="6">
											<div class="error">Sem Categoria Adicionada.</div>
										</td>
									</tr>

								<?php
							}
						}
					?>
				</table>
				
				<?php if(isset($_SESSION['id_restaurante']) != null) {?>
				<p><a href="../codigos/Administradores/AdicionarComida.php?id=<?php echo $_SESSION['id_restaurante']; ?>" class="btn-add">Adicionar</a></p>
				<?php } ?>
			    

				<div class="footer">
					<img src="../imagens/NozapBranco.png" alt="" />
					<span>© Copyright 2020 - ZapFood <br />Todos os direitos reservados</span>
				</div>
			</div>
		</div>		
	</body>


