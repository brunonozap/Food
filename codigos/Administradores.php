<?php
	if(!isset($_SESSION))
	{ 
		session_start();
	}

	include('BancoDeDados.php');
	include('ChecarLogin.php');
?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/administradores.css"/>
		<title>Administrativo</title>
	</head>
    
	<body>
		<div class="container-geral">
			<div id="add-restaurante-Fundo"> 
				<nav class="nav-bar">
					<div class="logo">
						<a href="index.php" title="Logo">
							<img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
						</a>
					</div> <!-- Logo -->

					<div class="cabeca">
						<ul id="links">
							<li><a href="ListaRestaurantes.php">Restaurante</a></li>
							<li><a href="Logout.php">Sair</a></li>
						</ul>
					</div> <!--Cabeca--> 					
                </nav> 

                <div class="BlocoCaixa">
					<h1>Página do Administrador</h1>
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

                    <div id="tabela">
						<table class = "table-full">
							<tr class="borda-superior">
								<th class="th-id">ID</th>
								<th class="th-name">Nome</th>
								<th class="th-user">Usuário</th>
								<th class="th-user">Taxa Entrega</th>
								<th class="th-action">Ações</th>
							</tr>

							<?php
							 	if($_SESSION['id_restaurante'] == 1)
								{
									$sql = "SELECT * FROM tabela_restaurantes";
								}

								else
								{
									$id = $_SESSION['id_restaurante'];
									$sql = "SELECT * FROM tabela_restaurantes WHERE id = '$id'";
								}

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
											$nome = $linhas['nome_restaurante'];
											$usuario = $linhas['usuario'];
											$taxa_entrega = $linhas['taxa_entrega'];

											?>

											<tr class="nomes-abaixo">
												<td><?php echo $id; ?></td>
												<td><?php echo $nome; ?></td>
												<td><?php echo $usuario; ?></td>
												<td><?php echo $taxa_entrega; ?></td>
																							
												<td class="td-action">
													<p></p>
													<p><a class="AtualizarSenha" href = "AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>">Mudar a Senha</a></p>
													<p><a class="AtualizarAdministrador" href = "AtualizarAdministrador.php?id=<?php echo $id; ?>">Atualizar Administrador</a></p>
													<p class="DeletarAdministrador"><a class="DeletarAdministrador" href = "DeletarAdministrador.php?id=<?php echo $id; ?>">Deletar Administrador</a></p>
												</td>
											</tr>

											<?php
										}
									}
								}
							?>
						</table>

					</div> <!-- Tabela -->
				</div> <!-- BlocoCaixa -->

				<div class="butao-AddRest">
					<a href="AdicionarRestaurante.php" class="add-Restaurante">Adicionar Restaurante</a>
				</div> <!--butao-AddRest-->
				
				</div> <!-- add-restaurante-Fundo -->
			</div> <!-- Container-Geral -->		
		
		<div class="footer-rodape-baixo">
			<img src="../imagens/NozapBranco.png" style="width:15%"/>
			© Copyright 2020 - ZapFood - Todos os direitos reservados
		</div> <!-- footer-rodape-baixo -->
	
	</body>
</html>


