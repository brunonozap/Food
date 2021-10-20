<?php
	if(!isset($_SESSION))
	{ 
		session_start();
	}

	ob_start();
	include('=BancoDeDados.php');
	include('=ChecarLogin.php');
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="=../css/pedidos_clientes.css" />
		<title>Pedidos</title>
	</head>
    
	<body>
		<div class="container-geral">
			<div id="add-restaurante-Fundo">
				<nav class="nav-bar">

					<!--<div class="logo">
						<a href="index.php" title="Logo">
							<img src="../../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
						</a>
					</div> -->

					<div class="cabeca">
						<img src="=../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
						<ul id="links">
							<li><a href="PainelControle.php">Painel Controle</a></li>
							<!--<li><a href="">Entregador</a></li>
							<li><a href="">Restaurante</a></li>
							<li><a href="">Carreiras</a></li>-->
							<li><a href="Logout.php">Sair</a></li>
						</ul>
					</div>
				</nav>
			
				
				

				<h1>Pedidos</h1>
				<p></p>
				
				<p></p>

				<div id = "tabela">
					<table class = "table-full">
						<tr class = "borda-superior">
							<th class = "alinhamento_th">ID</th>
							<th class = "alinhamento_th">Comida</th>
							<th class = "alinhamento_th">Preço</th>
							<th class = "alinhamento_th">Quantidade</th>
							<th class = "alinhamento_th">Total</th>
							<th class = "alinhamento_th">Data Pedido</th>
							<th class = "alinhamento_th">Estado</th>
							<th class = "alinhamento_th">Pago</th>
						</tr>

						<?php
							$id_cliente;

							if(isset($_SESSION['id']))
							{
								$id_cliente = $_SESSION['id'];
							}
					
							if(isset($_SESSION['id_restaurante']))
							{
								$id_cliente = $_SESSION['id_restaurante'];
							}

							$sql = "SELECT * FROM tabela_pedidos WHERE id_cliente='$id_cliente'";
							$res = mysqli_query($conn, $sql); //Executar a Query

							if($res == true) //Se a query foi executada
							{
								//Conta as linhas para verificar se há dados ou não na lista
								$tamanho_linhas = mysqli_num_rows($res);

								$contador = 0;

								if($tamanho_linhas > 0) //checar o número das linhas 
								{
									//temos dados no banco de dados
									while($linhas = mysqli_fetch_assoc($res))
									{
										//pegar todos os dados em loop e pegar dados individuais a cada iteração

										$id = $linhas['id'];
										$comida = $linhas['comida'];
										$preco = $linhas['preco'];
										$cliente = $linhas['nome_cliente'];
										$quantidade = $linhas['quantidade'];
										$total = $linhas['total'];
										$data_pedido = $linhas['data_ordem'];
										$estado = $linhas['estado'];
										$data_pedido = date("d-m-Y H:i:s", strtotime($data_pedido));
										$pago = $linhas['Pago'];

										if($pago == 0)
										{
											$pago = "Não";
										}

										if($pago == 1)
										{
											$pago = "Sim";
										}
										
										if($contador == 0){
										?>

										<tr class="primeira-info">
											<td div class="td"><?php echo $id; ?></td>
											<td div class="td"><?php echo $comida; ?></td>
											<td div class="td"><?php echo number_format($preco, 2, '.', ','); ?></td> <!-- para formatar o numero em 2 casas decimais depois do ponto -->
											<td div class="td"><?php echo $quantidade; ?></td>
											<td div class="td"><?php echo number_format($total, 2, '.', ','); ?></td>
											<td div class="td"><?php echo $data_pedido; ?></td>
											<td div class="td"><?php echo $estado; ?></td>
											<td div class="td"><?php echo $pago ?></td>
											
											<!--
											<td>
												<?php if(isset($_SESSION['nome_restaurante']) != null) { ?>
												<p></p>
												<p><a href = "<?php echo SITE_URL; ?>codigos/AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>"  class = "btn-primary">Mudar Senha</a></p>
												<p><a href = "<?php echo SITE_URL; ?>codigos/AtualizarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar Administrador</a></p>
												<p><a href = "<?php echo SITE_URL; ?>codigos/DeletarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Deletar Administrador</a></p>
												<?php } ?>
											</td> -->
										</tr>

										<?php
										}
										
										else { ?>
										<tr>
											<td div class="td"><?php echo $id; ?></td>
											<td div class="td"><?php echo $comida; ?></td>
											<td div class="td"><?php echo number_format($preco, 2, '.', ','); ?></td> <!-- para formatar o numero em 2 casas decimais depois do ponto -->
											<td div class="td"><?php echo $quantidade; ?></td>
											<td div class="td"><?php echo number_format($total, 2, '.', ','); ?></td>
											<td div class="td"><?php echo $data_pedido; ?></td>
											<td div class="td"><?php echo $estado; ?></td>
											<td div class="td"><?php echo $pago ?></td>
											
											<!--
											<td>
												<?php if(isset($_SESSION['nome_restaurante']) != null) { ?>
												<p></p>
												<p><a href = "<?php echo SITE_URL; ?>codigos/AtualizarSenhaAdministrador.php?id=<?php echo $id; ?>"  class = "btn-primary">Mudar Senha</a></p>
												<p><a href = "<?php echo SITE_URL; ?>codigos/AtualizarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar Administrador</a></p>
												<p><a href = "<?php echo SITE_URL; ?>codigos/DeletarAdministrador.php?id=<?php echo $id; ?>" class = "btn-green">Deletar Administrador</a></p>
												<?php } ?>
											</td> -->
										</tr>

										<?php }
										$contador++;
									}
								}
							}
						?>
					</table>
				</div>
			    

				<div class="footer">
					<img src="../imagens/NozapBranco.png" alt="" style="width:15%;"/>
					<span>© Copyright 2020 - ZapFood <br />Todos os direitos reservados</span>
				</div>
			</div>
		</div>		
	</body>


