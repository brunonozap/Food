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
		<link rel="stylesheet" href="../css/pedidos.css" />
		<title>Pedidos</title>
	</head>
    
	<body>
		<div class="container-geral">
			<div id="add-restaurante-Fundo">
				<nav class="nav-bar">
					
					<div class="logo">
						<a href="index.php" title="Logo">
							<img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
						</a>
					</div> 
					<!-- Logo -->

					<!-- HEADER -->
					<div class="cabeca">
						<ul id="links">
							<li><a href="../PainelControle.php">Painel Controle</a></li>
							<li><a href="../Logout.php">Sair</a></li>
						</ul>
					</div>	
				</nav>

				<div class="BlocoCaixa">
					<h1>Pedidos</h1>
					<p></p>
					
					<p></p>

					<?php 
						/*if(isset($_GET['pedidos']))
						{
							echo $_GET['pedidos']; //Mostra mensagem de sessão                              
						}*/
					?>

					
					<form action="" method="POST" >
						<select name="PeriodoPedidos" class = "Periodo-Pedidos">
							<option value="" disabled selected>Filtrar por Tempo</option>
							<option value="1">7 dias atrás</option>
							<option value="2">14 dias atrás</option>
							<option value="3">1 mês atrás</option>
							<option value="4">Todo o Período</option>
						</select>
						<input type="submit" value="Listar" class = "Periodo-Pedidos-Enviar"/>
					</form>

					<div id = "tabela">
				
					<!-- <form action="" method="POST" >								
						<input type="submit" value="Listar" />
					</form> -->
						<table class = "table-full">
								<tr class="borda-superior">
									<th div class="th-id">ID</th>
									<th div class="th-comida">Comida</th>
									<th div class="th-preco">Preço</th>
									<th div class="th-quantidade">Quantidade</th>
									<th div class="th-total">Total</th>
									<th div class="th-datapedido">Data Pedido</th>
									<th div class="th-estado">Estado</th>
									<th div class="th-nome">Nome Cliente</th>
									<th div class="th-contato">Contato</th>
									<th div class="th-email">E-mail</th>
									<th div class="th-endereco">Endereço</th>
									<th div class="th-acoes">Ações</th>
								</tr>

								<!--<form action="" method="POST" >
									<select name="PeriodoPedidos" class = "Periodo-Pedidos">
										<option value="" disabled selected>Filtrar por Tempo</option>
										<option value="1">7 dias atrás</option>
										<option value="2">14 dias atrás</option>
										<option value="3">1 mês atrás</option>
										<option value="4">Todo o Período</option>
									</select>
									<input type="submit" value="Listar" />
								</form> -->
								
							<?php
								date_default_timezone_set('UTC');
								$id_restaurante = $_SESSION['id_restaurante'];


								if(isset($_GET['pedidos']))
								{
									$periodo = $_GET['pedidos'];

									if($periodo == "1")
									{
										$data_hoje = date("Y-m-d");
										$data_semanapassada =  date("Y-m-d", strtotime("-7 days"));

										$sql = "SELECT * FROM tabela_pedidos WHERE data_ordem <= '$data_hoje'
										AND data_ordem >= '$data_semanapassada' AND 
											id_restaurante='$id_restaurante'";
									}

									else if($periodo == "2")
									{
										$data_hoje = date("Y-m-d");
										$data_semanapassada =  date("Y-m-d", strtotime("-14 days"));

										$sql = "SELECT * FROM tabela_pedidos WHERE data_ordem <= '$data_hoje'
										AND data_ordem >= '$data_semanapassada' AND 
											id_restaurante='$id_restaurante'";
									}

									else if($periodo == "3")
									{
										$data_hoje = date("Y-m-d");
										$data_semanapassada =  date("Y-m-d", strtotime("-1 month"));

										$sql = "SELECT * FROM tabela_pedidos WHERE data_ordem <= '$data_hoje'
										AND data_ordem >= '$data_semanapassada' AND 
											id_restaurante='$id_restaurante'";
									}

									else if($periodo == "4")
									{
										$sql = "SELECT * FROM tabela_pedidos WHERE id_restaurante='$id_restaurante'";
									}			
								}

								else
								{
									$sql = "SELECT * FROM tabela_pedidos WHERE id_restaurante='$id_restaurante'";
								}

								$contador = 0;

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
											//date_default_timezone_set('America/Sao_Paulo');
											$id = $linhas['id'];
											$comida = $linhas['comida'];
											$preco = $linhas['preco'];
											$cliente = $linhas['nome_cliente'];
											$quantidade = $linhas['quantidade'];
											$total = $linhas['total'];
											$data_pedido = $linhas['data_ordem'];
											$estado = $linhas['estado'];
											$nome_cliente = $linhas['nome_cliente'];
											$contato = $linhas['contato_cliente'];
											$email = $linhas['email_cliente'];
											$endereco = $linhas['endereco_cliente'];	
											$data_pedido = date("d-m-Y H:i:s", strtotime($data_pedido));							
											
											?>

											<?php 
											if($contador == 0)
											{
												?><tr class="nomes-abaixo distanciamento-topo" ><?php
											}

											else
											{
											?><tr class="nomes-abaixo"> <?php
											}

											$contador++;
											?>
												<td class="td-id" colspan="2"><?php echo $id; ?></td>
												<td class="td-comida" colspan="2"><?php echo $comida; ?></td>
												<td class="td-preco"><?php echo number_format($preco, 2, '.', ','); ?></td> <!-- para formatar o numero em 2 casas decimais depois do ponto -->
												<td class="td-quantidade"><?php echo $quantidade; ?></td>
												<td class="td-total"><?php echo number_format($total, 2, '.', ','); ?></td>
												<td class="td-datapedido"><?php echo $data_pedido ?></td>
												<td class="td-estado"><?php echo $estado; ?></td>
												<td class="td-nome"><?php echo $nome_cliente; ?></td>
												<td class="td-telefone"><?php echo $contato; ?></td>
												<td class="td-email"><?php echo $email; ?></td>
												<td class="td-endereco"><?php echo $endereco; ?></td>
												
												<td class="botao"> 
					
													<p><a class="AtualizarSenha" href = "AtualizarPedido.php?id=<?php echo $id; ?>" class = "btn-green">Atualizar </a></p>
													<p><a class="DeletarAdministrador" href = "DeletarPedido.php?id=<?php echo $id; ?>" class = "btn-green">Deletar </a></p>				
												</td>
											</tr>
							
											<?php
										}
									}
								}
								
							?>
										
						</table>

					<div class="clearfix"></div>
				</div>		
			</div>
		</div>
	
		<div class="footer">
			<img src="../imagens/VerdeFood.png" alt="" style="width:15%;"/>
			<span>© Copyright 2020 - ZapFood <br />Todos os direitos reservados</span>
		</div>
</html>

<?php 

if(isset($_POST['PeriodoPedidos']))
{	
	//echo "clicou";
	header('location: Pedidos.php?pedidos='.$_POST['PeriodoPedidos']);		
}
?>


