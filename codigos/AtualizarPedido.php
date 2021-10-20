<?php 
    include('BancoDeDados.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/attpedidos.css" />
		<title>Atualizar Pedido</title>
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

                    <!-- HEADER -->
                    <div class="cabeca">
                        <ul id = "links">
                            <li><a href="PainelControle.php">Painel de Controle</a></li>
                            <li><a href=".Administradores.php">Administrador</a></li>
                            <li><a href="Logout.php">Sair</a></li>
                        </ul>
                    </div>
                </nav>

                <div class="formulario-geral">
                    
                    <form id="formulario" action="" method="POST" enctype="multipart/form-data">


                        <h1 class="titulo">Atualizar Pedido</h1>

                        <table class="tbl-30">

                        <br></br>

                        <?php 
                            session_start();

                            //Pegar o ID do pedido selecionado
                            $id = $_GET['id'];

                            //Pegar os detalhes com a Query
                            $sql = "SELECT * FROM tabela_pedidos WHERE id = $id";

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
                                    
                                    $estado = $linha['estado'];
                                    

                                }

                                else
                                {
                                    //Redirecionar para a página de administrador
                                    header('location: Administradores.php');
                                }
                            }
                        ?>
                            <tr>
                                <td class = "texto_imagem">Categoria: </td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <select name="Estado">
                                                <option value="" disabled selected>Estado</option>
                                                <option value="Em Análise">Em Análise</option>
                                                <option value="Preparando">Preparando</option>
                                                <option value="Entregando">Entregando</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        </form>
                                    </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="submit" value="Atualizar" class="btn-secondary">
                                </td>
                            </tr>

                        </table>  
                    </form>
                </div>

                <?php
                    if(isset($_POST['submit']))
                    {                  

                        echo "Pedido Mudado";
                        //$estado = $_POST['estado'];

                        if(!empty($_POST['Estado']))
                        {
                            $estado = $_POST['Estado'];
                        }

                        $sql = "UPDATE tabela_pedidos SET
                                       estado = '$estado'
                                 WHERE id = '$id'
                        ";

                        $res = mysqli_query($conn, $sql);

                        if($res == true)
                        {
                            $_SESSION['update'] = "<div class = 'success'>Administrador Mudado</div>";

                            //Redirecionar para a página do Administrador
                            header('location: PedidosAdministradores.php');
                        }

                        else
                        {
                            $_SESSION['update'] = "<div class = 'success'>Administrador não Mudado</div>";

                            //Redirecionar para a página do Administrador
                            header('location: PedidosAdministradores.php');
                        }
                    }
                ?>
              
            </div>
        </div>

        <div class="footer-rodape-baixo"><br>
            <img src="../imagens/NozapBranco.png" style="width:15%"/>
            <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>
        </div> <!-- Footer-rodapé-Baixo -->
    </body>