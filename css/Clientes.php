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
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/admin.css"/>
		<title>Clientes</title>
	</head>
    
	<body>
		<div class="container-geral">
			<div id="add-restaurante-Fundo">
				<nav class="nav-bar">

					<div class="logo">
						<a href="index.php" title="Logo">
							<img src="imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
						</a>
					</div> 
					
					<!-- HEADER -->
					<div class="cabeca">
						<ul id = "links">
							<li><a href="PainelControle.php">Painel Controle</a></li>
							<li><a href="ListaRestaurantes.php">Restaurante</a></li>
							<li><a href="Logout.php">Sair</a></li>
						</ul>
					</div>

				</nav>	

				<div class="BlocoCaixa">
					<h1>Todos os Clientes</h1>
					<p></p>

					<form action="" method="POST" >
						<select name="Pedidos" class = "Periodo-Pedidos">
							<option value="" disabled selected>Últimos</option>
							<option value="7_dias">Últimos 7 Dias</option>
							<option value="30_dias">Últimos 30 Dias</option>
							<option value="60_dias">Últimos 60 Dias</option>
							<option value="todos_clientes">Todos os Clientes</option>
						</select>
						<input type="submit" value="Listar" class = "Periodo-Pedidos-Enviar"/>
					</form>

					<p></p>
			
					<div id = "tabela">
						<table class = "table-full">

							<?php				
								$id_restaurante = $_SESSION['id_restaurante'];
								
								//$sql = "SELECT * FROM tabela_usuarios;	
								
								//$sql = "SELECT * FROM tabela_usuarios WHERE ultimo_pedido BETWEEN '$data_anterior' AND '$data_atual'";

								if(isset($_GET['pedidos']))
								{
									?>
										<tr class="borda-superior">
											<th>Nome</th>
											<th>E-mail</th>
											<th>Bairro</th>
											<?php if($id_restaurante == 1) { ?>
											<!-- <th>Ações</th> -->
												<?php } ?>
										</tr>  
									<?php

									$periodo = $_GET['pedidos'];
									
		

									if($periodo == "7_dias")
									{
										$data_atual    = date("Y-m-d");
										$data_anterior = date("Y-m-d", strtotime("-7 days"));
										$sql = "SELECT * FROM tabela_pedidos WHERE id_restaurante = '$id_restaurante' AND 
											    data_ordem BETWEEN '$data_anterior' AND '$data_atual'";

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

													$nome = $linhas['nome_cliente'];
													$email = $linhas['email_cliente'];
													$bairro = $linhas['bairro'];

													?>

													<tr>
														<td><?php echo $nome; ?></td>
														<td><?php echo $email; ?></td>
														<td><?php echo $bairro; ?></td>

														<?php if($id_restaurante == 1) { ?>
														<!-- <td>
															<p></p>
															<p><a href = "AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>"  class = "btn-primary">Mudar Senha</a></p>
															<p><a href = "AtualizarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar Administrador</a></p>
															<p><a href = "DeletarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Deletar Administrador</a></p>
														</td> -->

														<?php } ?>
														
													</tr>

													<?php
												}
											}
										}
									}

									else if($periodo == "30_dias")
									{
										$data_atual    = date("Y-m-d");
										$data_anterior = date("Y-m-d", strtotime("-30 days"));
										$sql = "SELECT * FROM tabela_pedidos WHERE id_restaurante = '$id_restaurante' AND 
											    data_ordem BETWEEN '$data_anterior' AND '$data_atual'";

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

													$nome = $linhas['nome_cliente'];
													$email = $linhas['email_cliente'];
													$bairro = $linhas['bairro'];

													?>

													<tr>
														<td><?php echo $nome; ?></td>
														<td><?php echo $email; ?></td>
														<td><?php echo $bairro; ?></td>

														<?php if($id_restaurante == 1) { ?>
														<td>
															<p></p>
															<p><a href = "AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>"  class = "btn-primary">Mudar Senha</a></p>
															<p><a href = "AtualizarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar Administrador</a></p>
															<p><a href = "DeletarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Deletar Administrador</a></p>
														</td>

														<?php } ?>
														
													</tr>

													<?php
												}
											}
										}
									}

									else if($periodo == "60_dias")
									{
										$data_atual    = date("Y-m-d");
										$data_anterior = date("Y-m-d", strtotime("-60 days"));
										$sql = "SELECT * FROM tabela_pedidos WHERE id_restaurante = '$id_restaurante' AND 
											    data_ordem BETWEEN '$data_anterior' AND '$data_atual'";

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

													$nome = $linhas['nome_cliente'];
													$email = $linhas['email_cliente'];
													$bairro = $linhas['bairro'];

													?>

													<tr>
														<td><?php echo $nome; ?></td>
														<td><?php echo $email; ?></td>
														<td><?php echo $bairro; ?></td>

														<?php if($id_restaurante == 1) { ?>
														<td>
															<p></p>
															<p><a href = "AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>"  class = "btn-primary">Mudar Senha</a></p>
															<p><a href = "AtualizarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar Administrador</a></p>
															<p><a href = "DeletarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Deletar Administrador</a></p>
														</td>

														<?php } ?>
														
													</tr>

													<?php
												}
											}
										}
									}

									else
									{
										?>
										<tr class="borda-superior">
											<th>Nome</th>
											<th>Telefone</th>
											<th>Bairro</th>
										</tr> 
										<?php
										
										if($id_restaurante == 0)
										{
											$sql = "SELECT * FROM tabela_usuarios";
										}

										else
										{

											$sql = "SELECT * FROM tabela_pedidos WHERE id_restaurante = '$id_restaurante'";
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
		
													$nome = $linhas['nome_cliente'];
													$contato = $linhas['contato_cliente'];
													$bairro = $linhas['bairro'];
		
													?>
		
													<tr>
														<td div class="td"><?php echo $nome; ?></td>
														<td div class="td"><?php echo $contato; ?></td>
														<td div class="td"><?php echo $bairro; ?></td>
		

														<?php if($id_restaurante == 1) { ?>
														<!--<td>
															<p></p>
															<p><a href = "<?php echo SITE_URL; ?>codigos/Administradores/AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>"  class = "btn-primary">Mudar Senha</a></p>
															<p><a href = "<?php echo SITE_URL; ?>codigos/Administradores/AtualizarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar Administrador</a></p>
															<p><a href = "<?php echo SITE_URL; ?>codigos/Administradores/DeletarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Deletar Administrador</a></p>
														</td> -->
		
														<?php } ?>
														
													</tr>
		
													<?php
												}
											}
										}
									}


								}

								else
								{
									?>
									<tr class="borda-superior">
										<th>Nome</th>
										<th>Usuário</th>
										<th>Bairro</th>
									</tr> 
									<?php

									$sql = "SELECT * FROM tabela_usuarios";
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
	
												$nome = $linhas['nome'];
												$usuario = $linhas['usuario'];
												$bairro = $linhas['bairro'];
	
												?>
	
												<tr>
													<td div class="td"><?php echo $nome; ?></td>
													<td div class="td"><?php echo $usuario; ?></td>
													<td div class="td"><?php echo $bairro; ?></td>
	
													<?php if($id_restaurante == 1) { ?>
													<!--<td>
														<p></p>
														<p><a href = "<?php echo SITE_URL; ?>codigos/Administradores/AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>"  class = "btn-primary">Mudar Senha</a></p>
														<p><a href = "<?php echo SITE_URL; ?>codigos/Administradores/AtualizarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar Administrador</a></p>
														<p><a href = "<?php echo SITE_URL; ?>codigos/Administradores/DeletarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Deletar Administrador</a></p>
													</td> -->
	
													<?php } ?>
													
												</tr>
	
												<?php
											}
										}
									}
								}

								//echo $sql;
								/*if($id_restaurante == 1)
								{
									$sql = "SELECT * FROM tabela_usuarios";
								}

								else
								{
									$sql = "SELECT * FROM tabela_usuarios WHERE id='$id_restaurante'";
								}*/

							?>
						</table>

						<div class="clearfix"></div>
					</div>	
					
				</div>	
			</div>
		</div>
		
		
		<div class="footer">
			<img src="imagens/NozapBranco.png" alt="" style="width:15%;"/>
			<span>© Copyright 2020 - ZapFood <br />Todos os direitos reservados</span>
		</div>
	</body>

<?php 

	if(isset($_POST['Pedidos']))
	{
		header('Location: Clientes.php?pedidos='.$_POST['Pedidos']);	
	}
?>

