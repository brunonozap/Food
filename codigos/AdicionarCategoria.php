<?php 
    include('BancoDeDados.php');
    //include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/addCategoria.css"/>
		<title>Categoria</title>
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
						<li><a href="AdicionarRestaurante.php">Restaurante</a></li>
                        <li><a href="Categorias.php">Categoria</a></li>
						<li><a href="Logout.php">Sair</a></li>
					</ul> <!--links-->
				</div> <!--cabeca-->
                </nav>
                <div id="TituloCom-CaixaForm">

                        <?php
                            if(isset($_SESSION['add']))
                            {
                                echo $_SESSION['add']; //Mostra mensagem de sessão
                                unset($_SESSION['add']); //Remove mensagem de sessão
                            }
                        ?>

                    <div class="formulario-geral">
                        
                        <form id="formulario" action="" method="POST" enctype="multipart/form-data">
                            <h1 class="titulo">Adicionar Categoria</h1>
                            <table class="tbl-30">
                                <tr>
                                    <td ><input type="text" class="margem_espaçamento distanciamento_img1"  name="titulo" placeholder="Título"></td>
                                </tr>

                                <tr>
                                    <td class = "texto_imagem">Imagem: </td>
                                    <td>
                                        <label for="arquivo">Enviar Arquivo</label>
                                        <input type="file" name="nome_imagem" id="arquivo">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                          
                                        <input class="margem_espaçamento" type="checkbox" id="flexSwitchCheckChecked" name="apresentado">
                                        <label class="margem_espaçamento" for="flexSwitchCheckChecked">Apresentado</label>
                            
                                    </td>
                                </tr>
                
                                <tr>
                                    <td>
                          
                                        <input class="margem_espaçamento" type="checkbox" id="flexSwitchCheckDefault" name="ativo">
                                        <label class="margem_espaçamento" for="flexSwitchCheckDefault">Ativo</label>
                                  
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <input type="submit" class="margem_espaçamento" name="submit" value="Criar" >
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div> <!-- Formulario-Geral -->
              </div> <!--TituloCom-CaixaForm-->
            </div> <!--add-restaurante-Fundo-->
        </div> <!--Container-Geral-->
        
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
        $nome_imagem = $_POST['nome_imagem'];       

        if(isset($_POST['apresentado']))
        {
            $apresentado = $_POST['apresentado'];//
        }

        else
        {
            $apresentado = "off";
        }

        if(isset($_POST['ativo']))
        {
            $ativo = $_POST['ativo'];
        }

        else
        {
            $ativo = "off";
        }

        if(isset($_FILES['nome_imagem']['name']))
        {
            $nome_imagem = $_FILES['nome_imagem']['name'];

            //isso pega o tipo de arquivo que você está enviando
            $extensao = end(explode('.', $nome_imagem));

            //renomeia o nome da imagem que você está enviando
            //$nome_imagem = "Categoria_Comida_".rand(000, 999).'.'.$extensao;
            $nome_imagem = $nome_imagem.'.'.$extensao;

            $caminho_imagem = $_FILES['nome_imagem']['tmp_name'];
            $caminho_destino = "../imagens/".$nome_imagem;
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

        else
        {
            $nome_imagem = "";
        }
        
        //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
        $sql = "INSERT INTO tabela_categoria SET
                            titulo='$titulo',
                            nome_imagem='$nome_imagem',
                            apresentado='$apresentado',
                            ativo='$ativo' ";

        echo $sql;

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            $_SESSION['add'] = "Categoria adicionada com sucesso";

            header("location: Categorias.php");
        }
    }
?>