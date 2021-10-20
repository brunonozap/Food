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
        <link rel="stylesheet" href="../css/atualizarsenhausuario.css" />
		<title>Atualizar Usuario</title>
	</head>
    
	<body>
		<div class="container-geral">
            <div id="add-restaurante-Fundo"> 
                <nav class="nav-bar">

                    <div class="logo">
                        <a href="../index.php" title="Logo">
                            <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
                        </a>
                    </div> 
                    <!-- Logo -->

                    <!-- HEADER -->
                    <div class="cabeca">
                        <ul id="links">
                            <li><a href="index.php">Entregador</a></li> |
                            <li><a href="RestauranteCliente.php">Restaurante</a></li> 
                            <!-- li><a href="">Carreiras</a></li> -->
                        </ul>
                    </div>

                </nav>

                <br></br>

                <?php 
                    if(isset($_SESSION['id']))
                    {
                        $id = $_SESSION['id'];
                    }
                ?>

                <div class="formulario-geral">

                    <form id="formulario" action = "" method = "POST">
                        <h1 class="titulo">Atualizar Senha</h1>

                        <table class = "tbl-30">
                            <tr>
                                <td>Senha Nova</td>
                                <td><input type="password" name="nova_senha" placeholder = "Senha Nova"></td>
                            </tr>

                            <tr>
                                <td>Confirmar Senha</td>
                                <td><input type="password" name="senha_confirmada" placeholder = "Senha Confirmada" ></td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="submit" name="submit" value="Atualizar" class="btn-secondary">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

                <?php
                    if(isset($_POST['submit']))
                    {                             
                        //$id = $_POST['id'];
                        //$senha_atual = md5($_POST['senha_atual']);//md5($_POST['senha_atual']);
                        $nova_senha = md5($_POST['nova_senha']);//md5($_POST['nova_senha']);
                        $senha_confirmada = md5($_POST['senha_confirmada']);//md5($_POST['senha_confirmada']);

                        //Verificar se o usuário e a senha existem
                        $sql = "SELECT * FROM tabela_usuarios WHERE
                                id = '$id'";

                        //Checar se a nova senha e a senha de confirmação é igual ou não
                        $res = mysqli_query($conn, $sql);
                                        
                        if($res == true)
                        {
                            $contador_linhas = mysqli_num_rows($res);

                            if($contador_linhas == 1)
                            {
                                //Usuario existe e senha pode ser trocada
                                //Verifica se a nova senha é igual a senha confirmada

                                if($nova_senha == $senha_confirmada)
                                {
                                    $sql2 = "UPDATE tabela_usuarios SET
                                            senha='$nova_senha' WHERE id='$id'";

                                    $res2 = mysqli_query($conn, $sql2); 

                                    if($res2 == true)
                                    {
                                        //Mostrar mensagem de sucesso
                                        $_SESSION['change-pwd'] = "<div class = 'success'>Senha mudada com sucesso</div>";

                                        echo "Senha mudada";

                                        //Redirecionar para a página do Administrador
                                        //header('location:'.SITE_URL.'codigos/Administrador.php');
                                    }

                                    else
                                    {
                                        $_SESSION['pwd-not-match'] = "<div class = 'error'>Senha não mudada</div>";
                                        echo "Senha não mudada";

                                        //Redirecionar para a página do Administrador
                                        //header('location:'.SITE_URL.'codigos/Administrador.php');
                                    }
                                }

                                else
                                {
                                    $_SESSION['pwd-not-match'] = "<div class = 'error'>Senha não confere</div>";
                                    echo "Senha não confere";
                                    //Redirecionar para a página do Administrador
                                    header('location: PainelControle.php');
                                }
                            }
                            
                            else
                            {
                                $_SESSION['user-not-found'] = "<div class = 'error'>Usuario não Encontrado</div>";
                                echo "Usuario não encontrado";
                                //Redirecionar para a página do Administrador
                                header('location: PainelControle.php');
                            }
                        }
                        //Trocar a senha se isso tudo for verdade
                    }
                ?>
            </div>
        </div>

        
        <div class="footer-rodape-baixo">
            <img src="../imagens/NozapBranco.png" alt="" style="width:15%;"/>
            <span>© Copyright 2020 - ZapFood Todos os direitos reservados</span>
        </div>
    </body>