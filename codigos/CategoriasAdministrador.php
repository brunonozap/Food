<?php
	if(!isset($_SESSION))
	{ 
		session_start();
	}

	ob_start();
	include('../BancoDeDados.php');
	include('../ChecarLogin.php');
?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../../css/categorias.css"/>
		<title>Categorias</title>
	</head>
    
	<body>
		<div class="container-geral">
			<nav class="nav-bar">

				<div class="logo">
                    <a href="../../codigos/index.php" title="Logo">
                        <img src="../../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                </div> 
				<!-- Logo -->
		
				<div class="cabeca">
					<ul>
						<li><a href="ListaRestaurantes.php">Restaurante</a></li>
						<li><a href="../PainelControle.php">Painel Controle</a></li>
						<li><a href="Logout.php">Sair</a></li>
					</ul>
				</div>	

			</nav> 
		</div>

			<div class="BlocoCaixa">
				<h1>Categorias</h1>
				<p></p>

				<!-- <p><a href="../codigos/AdicionarCategoria.php" class="btn-green">Adicionar</a></p> -->

				<div id = "tabela">
					<table class = "table-full">
						<tr class="borda-superior">
							<th class="th-id">ID</th>
							<th class="th-name">Titulo</th>
							<th class="th-image">Nome Imagem</th>
							<th class="th-action">Ações</th>
						</tr>

						<?php
							$sql = "SELECT * FROM tabela_categoria";
							$res = mysqli_query($conn, $sql); //Executar a Query
							$id_restaurante = $_SESSION['id_restaurante'];

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

										<tr class="nomes-abaixo">
											<td ><?php echo $id; ?></td>
											<td ><?php echo $titulo; ?></td>
											<td ><img src="../imagens/<?php echo $nome_imagem;?>" width="100px" height="100px"></td>
											<td class="td-action">
												<?php if($id_restaurante == 1) {?>
												<p></p>
												<p class="espaco_botoes"><a class="AtualizarSenha" href = " AtualizarCategoria.php?id=<?php echo $id; ?>">Mudar</a></p>
												<p></p>
												<p class="espaco_botoes"><a class="AtualizarSenha" href = " DeletarCategoria.php?id=<?php echo $id; ?>&nome_imagem=<?php echo $nome_imagem; ?>" >Deletar</a></p>
												<?php }?>
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
				</div> <!-- tabela -->
			</div> <!-- BlocoCaixa -->
				

			<div class="butao-AddRest">
				<a href="AdicionarCategoria.php" class="add-Restaurante">Adicionar Categoria</a>
			</div> <!--butao-AddRest-->
			
				
		</div>

		<div class="footer-rodape-baixo">
			<img src="../../imagens/NozapBranco.png" style="width:15%"/>
			© Copyright 2020 - ZapFood - Todos os direitos reservados
		</div> <!-- footer-rodape-baixo -->			
	
	</body>


