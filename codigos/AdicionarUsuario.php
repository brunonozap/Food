<?php 
    include('BancoDeDados.php');
    //include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="../css/addUser.css"/>
		<title>Administrativo</title>
	</head>
    
	<body>
    <div id="add-Usuario-Fundo"> 
		<div class="container-geral">
			<nav class="nav-bar">
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="../imagens/VerdeFood.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                    </div> <!-- Logo -->
				<div class="cabeca">
					<ul id="links">
						<li><a href="../codigos/Clientes/Restaurante.php">Restaurante</a></li>
						<li><a href="Logout.php">Sair</a></li>
					</ul>
				</div><!-- cabeca -->
                </nav>

                        <?php
                            if(isset($_SESSION['add']))
                            {
                                echo $_SESSION['add']; //Mostra mensagem de sessão
                                unset($_SESSION['add']); //Remove mensagem de sessão
                            }
                        ?>
                        
                        <h1 class="titulo">Adicionar Usuario</h1>
                        <div class="formulario-geral">

                        <form id="formulario" action="" method="POST">

                            <table class="tbl">
                                <tr>
                                    <td>Nome Completo: </td>
                                    <td><input type="text" name="nome" placeholder="Digite o Seu Nome"></td>
                                </tr>

                                <tr>
                                    <td>Usuario: </td>
                                    <td><input type="text" name="usuario" placeholder="Digite o Seu Usuario"></td>
                                </tr>

                                <tr>
                                    <td>Senha: </td>
                                    <td><input type="password" name="senha" placeholder="Digite a Sua Senha"></td>
                                </tr>

                                <tr>
                                    <td>Bairro: </td>
                                    <td><input type="text" name="bairro" placeholder="Digite o Seu Usuario"></td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <input type="submit" name="submit" value="Criar" class="btn-secondary">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div> <!-- Formulário-Geral-->
                </div> <!-- Container-Geral-->
            </div> <!-- add-Usuario-Fundo -->
            
    <div class="footer-rodape-baixo"><br>
	<img src="../imagens/VerdeFood.png" style="width:15%"/>
	<span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>

</div> <!-- Footer-rodapé-Baixo -->
    </body>


<?php 
    //Aqui ele processa o valor do formulário e salva no banco de dados
    if(isset($_POST['submit'])) // Ele verifica se o botão foi clicado ou não
    {
        session_start();
        //Botão clicado, agora vou ter que pegar as informações no name do formulário
        $nome = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = md5($_POST['senha']); //md5 para encriptação de senha
        $bairro = $_POST['bairro'];
        
        //Tenho que verificar se o restaurante com o mesmo nome e usuário foi criado, para não ter duplicidade no banco de dados
        $sql0 = "SELECT nome, usuario FROM tabela_usuarios WHERE nome='$nome' and usuario='$usuario'";
        $res0 = mysqli_query($conn, $sql0);
        $tamanho_linhas = mysqli_num_rows($res0);

        if($tamanho_linhas < 1)
        {
            //$tamanho_linhas = mysqli_num_rows($res0);

            // if($duplicidade < 1)
            // {
                //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
                $sql = "INSERT INTO tabela_usuarios SET
                                    nome='$nome',
                                    usuario='$usuario',
                                    senha='$senha',
                                    bairro='$bairro' ";

                echo $sql;

                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                echo "<br>";
                var_dump($res);

                if($res == true)
                {
                    echo "Funcionou";
                    $_SESSION['add'] = "Usuario adicionado com sucesso";

                    header("location:Login.php");
                }
                
                else 
                {
                    echo "Erro";
                }
            // }
        }
                   
        else
        {
            $_SESSION['add'] = "Usuario já existente";

            header("location:Login.php");
        }
    }
?>