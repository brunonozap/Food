<?php
    if(!isset($_SESSION))
    { 
        session_start();
    }

    ob_start();
    include('BancoDeDados.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/attadministrador.css" />
		<title>Atualizar Administrativo</title>
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
                            <li><a href="PainelControle.php">Painel de Controle</a></li>
                            <li><a href="Administradores.php">Administrador</a></li>
                            <li><a href="Logout.php">Sair</a></li>
                        </ul>
                    </div>

                </nav>

                <br></br>

                <div class="formulario-geral">

                <?php 
                    /*define('SITE_URL', 'https://localhost/NoZapShop/');
                    define('LOCALHOST', 'localhost');
                    define('DB_USUARIO', 'root');
                    define('DB_SENHA', '');
                    define('DB_NOME', 'nozapbd');
                
                    $conn = mysqli_connect(LOCALHOST, DB_USUARIO, DB_SENHA) or die(mysqli_error()); //conexão com banco de dados, dizendo o endereço dele, o usuário e senha
                    $db_selecionado = mysqli_select_db($conn, DB_NOME) or die(mysqli_error());*/


                    //Pegar o ID do administrador selecionado
                    $id = $_GET['id'];

                    //Pegar os detalhes com a Query
                    $sql = "SELECT * FROM tabela_restaurantes WHERE id = $id";

                    //Executar a Query
                    $res = mysqli_query($conn, $sql);


                    if($res == true)
                    {
                        //Checar se há dados ou não
                        $quantidade_linhas = mysqli_num_rows($res);

                        if($quantidade_linhas == 1)
                        {
                            //Pegar os detalhes do administrador
                            $linha = mysqli_fetch_assoc($res);
                            
                            $nome = $linha['nome_restaurante'];
                            $usuario = $linha['usuario'];
                            $email = $linha['email'];
                            $telefone = $linha['telefone'];
                            $taxa_entrega = $linha['taxa_entrega'];
                        }

                        else
                        {
                            //Redirecionar para a página de administrador
                            header('location: Administradores.php');
                        }
                    }


                ?>
                <div class="formulario-geral">
                    <form id="formulario" action = "" method = "POST" enctype="multipart/form-data">
                        
                        <h1 class="titulo">Atualizar Administrador</h1>
                             
                        <table class = "tbl-30">
                            <tr>
                                <td>Nome</td>
                                <td><input type="text" name="nome" value="<?php echo $nome; ?>"> </td>
                            </tr>

                            <tr>
                                <td>Usuario</td>
                                <td><input type="text" name="usuario" value="<?php echo $usuario; ?>"></td>
                            </tr>
                            
                            <tr>
                                <td>E-Mail</td>
                                <td><input type="text" name="e-mail" value="<?php echo $email; ?>"></td>
                            </tr>
                            
                            <tr>
                                <td>Telefone</td>
                                <td><input type="text" name="telefone" value="<?php echo $telefone; ?>"></td>
                            </tr>

                            <tr>
                                <td>Taxa Entrega</td>
                                <td><input type="number" name="taxa_entrega" value="<?php echo $taxa_entrega; ?>" step="any" pattern="^\d*(\.\d{0,2})?$"></td>
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
        </div>


        <div class="footer-rodape-baixo">
            <img src="../imagens/NozapBranco.png" alt="" style="width:15%;"/>
            <span>© Copyright 2020 - ZapFood Todos os direitos reservados</span>
        </div>
      
       
    </body>

    <?php
                    if(isset($_POST['submit']))
                    {      
                        //echo "Administrador Mudado";
                        //$id = $_POST['id'];
                        $nome = $_POST['nome'];
                        $usuario = $_POST['usuario'];
                        $email = $_POST['e-mail'];
                        $telefone = $_POST['telefone'];
                        $taxa_entrega = $_POST['taxa_entrega'];

                        echo $taxa_entrega;

                        $sql1 = "UPDATE tabela_restaurantes SET
                                       nome_restaurante = '$nome',
                                       usuario = '$usuario',
                                       email = '$email',
                                       telefone = '$telefone',
                                       taxa_entrega = '$taxa_entrega'
                                 WHERE id = '$id'
                        ";


                        echo $sql1;

                        //$res = mysqli_refresh($conn, 1);

                        $res1 = mysqli_query($conn, $sql1);

                        echo $res1;

                        if($res1 == true)
                        {
                            $_SESSION['update'] = "<div class = 'success'>Administrador Mudado</div>";
                            mysqli_close($conn);
                            //Redirecionar para a página do Administrador
                            header('location: Administradores.php');
                        }

                        else
                        {
                            $_SESSION['update'] = "<div class = 'success'>Administrador não Mudado</div>";
                            echo $res1;
                            //Redirecionar para a página do Administrador
                            //header('location:'.SITE_URL.'codigos/Administradores/Administradores.php');
                            header('location: Administradores.php');
                        }
                    }
                ?>