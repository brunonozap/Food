<?php 

    if(!isset($_SESSION))
    { 
        session_start();
    }

    include('BancoDeDados.php');
    //include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/addComida.css" />
		<title>Administrativo</title>
	</head>
    
	<body>
		<div class="container">
            <div id="add-restaurante-Fundo">
			<nav class="navbar">
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive img">
                    </a>
                </div> 
				<!-- Logo -->

				<!-- HEADER -->
				<div class="header">
					<ul>						
						<li><a href="ListaRestaurantes.php">Restaurante</a></li>
						<li><a href="PainelControle.php">Painel Controle</a></li>
                        <li><a href="Administradores.php">Administrador</a></li>
					</ul>
				</div>
            </nav>


            <div class="formulario-geral">
                            
                <form id="formulario" action="" method="POST" enctype="multipart/form-data">
                    <h1 class="titulo">Adicionar Comida</h1>

                    <table class="tbl-30">

                        <tr>
                
                            <td><input type="text" name="titulo" class="margem_espaçamento" placeholder="Digite o Título da Comida"></td>
                        </tr>

                        <tr>
                    
                            <td><input type="text" name="descricao" class="margem_espaçamento" placeholder="Digite a Descrição da Comida"></td>
                        </tr>

                        <tr>
                        
                            <td><input type="number" name="preco" class="margem_espaçamento distanciamento_img1" placeholder="Digite o Preço" step="0.01"></td>
                        </tr>

                        <tr>
                            <td class = "texto_imagem">Imagem: </td>
                            <td>
                                <label for="arquivo">Enviar Arquivo</label>
                                <input type="file" name="arquivo" placeholder="Insira a Imagem da Comida" id="arquivo">
                            </td>
                        </tr>

                        <tr>
                
                            <td><form action="" method="POST" enctype="multipart/form-data">
                                <select name="categoria" class="categoria">
                                    <option value="" disabled selected>Escolha a Categoria</option>
                                        <?php
                                            //$id = $_GET['id'];
                                            $sql = "SELECT * FROM tabela_categoria";
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
                                                        $titulo = $linhas['titulo'];
                                                        ?>
                                                            <option value="<?php echo $titulo; ?>"><?php echo $titulo; ?></option>
                                                        <?php 
                                                    }
                                                }
                                            }
                                        ?>   
                                    </select>                  
                                </form>
                            </td>
                        </tr>   
                            
                            <tr>
                                <td>
                                    <div class="form-check form-switch primeira-pagina">
                                        <label for="flexSwitchCheckChecked" class="centralizar">Primeira Página</label>
                                        <td><input class="form-check-input primeira-pagina" type="checkbox" id="flexSwitchCheckChecked" name="apresentado"></td> 
                                    </div>
                                </td>
                            </tr> 

                            <tr>
                                <td>
                                    <div class="form-check form-switch ativo">
                                    <label class="centralizar" for="flexSwitchCheckChecked">Ativo</label>
                                    <td><input class="form-check-input ativo" type="checkbox" id="flexSwitchCheckChecked" name="ativo"></td>   
                                    </div>
                                </td>
                            </tr>                                                                                             
                        
                            <td colspan="2">
                                <input type="submit" name="submit" value="Criar" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div> <!-- Formulario-Geral -->    
        </div>

                                        </div>

        <div class="footer-rodape-baixo"><br>
	        <img src="../imagens/NozapBranco.png" style="width:15%"/>
	        <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>
        </div> <!-- Footer-rodapé-Baixo -->
          
    </body>


<?php 
    //Aqui ele processa o valor do formulário e salva no banco de dados
    if(isset($_POST['submit'])) // Ele verifica se o botão foi clicado ou não
    {
        session_start();
        //Botão clicado, agora vou ter que pegar as informações no name do formulário
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        is_float($preco = $_POST['preco']); 
        $imagem = $_POST['imagem']; 
        $restaurante = $_GET['id'];

        if(!empty($_POST['Categorias']))
        {
            $categoria = $_POST['Categorias'];
        }

        if(isset($_FILES['imagem']['name']))
        {
            $nome_imagem = $_FILES['imagem']['name'];

            //isso pega o tipo de arquivo que você está enviando
            //$extensao = end(explode('.', $nome_imagem));

            //renomeia o nome da imagem que você está enviando
            //$nome_imagem = "Categoria_Comida_".rand(000, 999).'.'.$extensao;
            //$nome_imagem = $nome_imagem.'.'.$extensao;

            $caminho_imagem = $_FILES['imagem']['tmp_name'];
            $caminho_destino = "../imagens/comidas/".$nome_imagem;
            $envio = move_uploaded_file($caminho_imagem, $caminho_destino);

            if($envio==false)
            {
                $_SESSION['envio'] = "<div class='error'>Falhou em enviar a nova imagem</div>";
                header('location: AdicionarCategoria.php');
                die();
            }

            else
            {
                header('location: PainelControle.php');
            }
        }

        
         //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
         $sql = "INSERT INTO tabela_comida SET
                             titulo='$titulo',
                             descricao='$descricao',
                             preco='$preco',
                             nome_imagem='$nome_imagem',
                             id_categoria='$categoria',
                             apresentado='$apresentado',
                             ativo='$ativo',
                             id_restaurante='$restaurante' ";

        echo $sql;

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            $_SESSION['add'] = "Comida adicionada com sucesso";

            header('location: Comidas.php');
        }

        header('location: PainelControle.php');
    }
?>