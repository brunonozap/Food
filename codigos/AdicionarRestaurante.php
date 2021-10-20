<?php 
    session_start();

    ob_start();
    include('BancoDeDados.php');
    //include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/addRest.css"/>
		<title>Administrativo</title>
	</head>
    
	<body> 
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Mostra mensagem de sessão
                unset($_SESSION['add']); //Remove mensagem de sessão
            }
        ?>
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
						<li><a href="../codigos/Clientes/Restaurante.php">Restaurante</a></li>
						<li><a href="Logout.php">Sair</a></li>
					</ul>
				</div> <!--Cabeca--> 
                </nav> 

                        <div class="formulario-geral">
                        
                        <form id="formulario" action="" method="POST" enctype="multipart/form-data">
                            <h1 class="titulo">Adicionar Restaurante</h1>
                            <table class="tbl-30">
                                <tr>
                                    <td><input type="text" class="margem_espaçamento" name="nome" placeholder="Nome do Restaurante" required></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="margem_espaçamento" name="usuario" placeholder="Nome do Usuário" required></td>
                                </tr>

                                <tr>
                                    <td><input type="password" class="distanciamento_img1 margem_espaçamento" name="senha" placeholder="Digite a Sua Senha" required></td>
                                </tr>

                                <tr>
                                    <td class = "texto_imagem">Imagem: </td>
                                    <td>
                                        <label for="arquivo">Enviar Arquivo</label>
                                        <input type="file" name="nome_imagem" id="arquivo" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td><input type="text" name="telefone" class="distanciamento_img2" placeholder="Telefone:" required></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="margem_espaçamento" name="e-mail" placeholder="Inserir e-mail:" required></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="margem_espaçamento distanciamento_img1" name="bairro" placeholder="Bairro:" required></td>
                                </tr>

                                <tr>
                                    <td><input type="number" class="taxa_entrega" name="taxa_entrega" placeholder="Taxa Entrega:" step="any" required></td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <input type="submit" class="margem_espaçamento" name="submit" value="Criar" >
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div> <!-- Formulario-Geral -->
                    </div> <!-- add-restaurante-img -->
                    </div> <!-- Container-Geral-->
    <div class="footer-rodape-baixo"><br>
	<img src="../imagens/VerdeFood.png" style="width:15%"/>
	<span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>

</div> <!-- Footer-rodapé-Baixo -->

    </body>
    </html>


<?php 
    //Aqui ele processa o valor do formulário e salva no banco de dados
    if(isset($_POST['submit'])) // Ele verifica se o botão foi clicado ou não
    {
        //Botão clicado, agora vou ter que pegar as informações no name do formulário
        $nome = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = md5($_POST['senha']); //md5 para encriptação de senha
        $telefone = $_POST['telefone'];
        $nome_imagem = $_POST['nome_imagem'];
        $email = $_POST['e-mail'];
        $bairro = $_POST['bairro'];
        $taxa_entrega = $_POST['taxa_entrega'];
        
        //Tenho que verificar se o restaurante com o mesmo nome e usuário foi criado, para não ter duplicidade no banco de dados
        $sql0 = "SELECT nome_restaurante, usuario FROM tabela_restaurantes WHERE nome_restaurante='$nome' and usuario='$usuario'";
        $res0 = mysqli_query($conn, $sql0);
        $tamanho_linhas = mysqli_num_rows($res0);

        if($tamanho_linhas < 1)
        {
            //$tamanho_linhas = mysqli_num_rows($res0);

            if($duplicidade < 1)
            {

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

                //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
                $sql = "INSERT INTO tabela_restaurantes SET
                                    nome_restaurante='$nome',
                                    usuario='$usuario',
                                    senha='$senha',
                                    email='$email',
                                    telefone='$telefone',
                                    nome_imagem='$nome_imagem',
                                    bairro='$bairro',
                                    taxa_entrega='$taxa_entrega'";

                echo $sql;

                $res = mysqli_query($conn, $sql);

                if($res == true)
                {
                    $_SESSION['add'] = "Administrador adicionado com sucesso";

                    header("location:Login.php");
                }
            }

            else
            {
                header("location:Login.php");
            }
        }
                   
        else
        {
            $_SESSION['add'] = "Administrador já existente";

            header("location:".SITE_URL.'codigos/Administradores/Administradores.php');
        }
    }
?>