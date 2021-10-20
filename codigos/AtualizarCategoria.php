<?php
	if(!isset($_SESSION))
	{ 
		session_start();
	}

	ob_start(); //aqui foi para limpar a parte do erro de não redirecionamento para a página de categoria 
	include('BancoDeDados.php');
	include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
        <link rel="stylesheet" href="../css/attCategoria.css"/>
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
   
                <div class="formulario-geral">
                    
                        <form id="formulario" action="" method="POST" enctype="multipart/form-data">


                        <h1 class="titulo">Atualizar Categoria</h1>

                            <table class="tbl-30">

                                <tr>
                         
                                    <td><input type="text" class = "margem_espaçamento distanciamento_img1" name="titulo" placeholder="Digite o Seu Nome"></td>
                                </tr>

                                <tr>
                                    <td class = "texto_imagem">Imagem:</td>
                                    <td>
                                        <label for="arquivo">Enviar Arquivo</label>
                                        <input type="file" name="nome_imagem" id="arquivo">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="form-check form-switch-A ">
                                        <label class="form-check-label texto_apresentado" for="flexSwitchCheckChecked">Apresentado</label>
                                        <input class="form-check-input apresentado" type="checkbox" id="flexSwitchCheckChecked" name="apresentado">
                                        </div>
                                    </td>
                                </tr>
                
                                <tr>
                                    <td>
                                        <div class="form-check form-switch-B ">
                                        <label class="form-check-label texto_ativo" for="flexSwitchCheckDefault">Ativo</label>
                                        <input class="form-check-input ativo" type="checkbox" id="flexSwitchCheckDefault" name="ativo">
                                        </div>
                                   </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <input type="submit" name="submit" value="Atualizar">
                                    </td>
                                </tr>
                            </table>
                        </form>
                </div> <!--caixa-formulario-->


                <?php
                    if(isset($_POST['submit']))
                    {                  
                        //echo "Categoria Mudada";
                        $id = $_POST['id'];
                        $titulo = $_POST['titulo'];
                        $nome_imagem2 = $_FILES['nome_imagem2']; 
                        //echo $_FILES['nome_imagem2']['name'];

                        if(!isset($_POST['apresentado']))
                        {
                            $apresentado = "off";
                        }

                        else
                        {
                            $apresentado = $_POST['apresentado'];  
                        }
                
                        if(!isset($_POST['ativo']))
                        {
                            $ativo = "off";
                        }

                        else
                        {
                            $ativo = $_POST['ativo']; 
                        }

                        
                        //Se foi inserido uma imagem, então ele troca
                        if(isset($_FILES['nome_imagem2']['name']))
                        {                           
                            $nome_imagem2 = $_FILES['nome_imagem2']['name'];

                            if($nome_imagem2 != "")
                            {
                                $tmp = explode('.', $nome_imagem2);

                                //isso pega o tipo de arquivo que você está enviando
                                $extensao = end($tmp);

                                $caminho_imagem = $_FILES['nome_imagem2']['tmp_name'];

                                $caminho_destino = "../imagens/".$nome_imagem2;

                                $envio = move_uploaded_file($caminho_imagem, $caminho_destino);

                                //Se falhou em enviar a imagem
                                if($envio == false)
                                {
                                    $_SESSION['envio'] = "<div class='error'>Falhou em enviar a nova imagem</div>";
                                    //header('location: AdicionarCategoria.php');
                                    //die();
                                }

                                if($nome_imagem != "")
                                {
                                    $caminho_remocao = "../imagens/".$nome_imagem;
                                    $remover = unlink($caminho_remocao);
    
                                    if($remover == false)
                                    {
                                        $_SESSION['remover'] = "Não removeu a imagem antiga";
                                    }

                                    else
                                    {
                                        $_SESSION['remover'] = "Removeu imagem antiga com sucesso";
                                    }
                                }                                  
                            }

                            else
                            {
                                $nome_imagem2 = $nome_imagem;
                            }

                            $_SESSION['envio'] = "<div class='sucess'>Deu certo</div>";                          
                        }

                        else
                        {
                            $nome_imagem2 = $nome_imagem;
                        }

                       
                        $sql = "UPDATE tabela_categoria SET
                                       titulo = '$titulo',
                                       nome_imagem = '$nome_imagem2',
                                       apresentado = '$apresentado',
                                       ativo = '$ativo'
                                 WHERE id = '$id'
                        ";
                        
                        
                        $res = mysqli_query($conn, $sql);

                        if($res == true)
                        {
                            $_SESSION['update'] = "Categoria Mudada ";

                            //Redirecionar para a página do Administrador
                            exit(header('location: Categorias.php'));
                            die();
                        }

                        else
                        {
                            $_SESSION['update'] = "Categoria não Mudada";
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

    <?php 
      
      //Pegar o ID do administrador selecionado
      $id = $_GET['id'];

      //Pegar os detalhes com a Query
      $sql = "SELECT * FROM tabela_categoria WHERE id = $id";

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
              
              $titulo = $linha['titulo'];
              $nome_imagem = $linha['nome_imagem'];  
              $apresentado = $linha['apresentado'];   
              $ativo = $linha['ativo'];                                  
          }

          else
          {
              //Redirecionar para a página de administrador
              //header('location:'.SITE_URL.'codigos/Administradores.php');
          }
      }
    ?>

    <?php
                    if(isset($_POST['submit']))
                    {                  
                        //echo "Categoria Mudada";
                        $id = $_POST['id'];
                        $titulo = $_POST['titulo'];
                        $nome_imagem2 = $_FILES['nome_imagem2']; 
                        //echo $_FILES['nome_imagem2']['name'];

                        if(!isset($_POST['apresentado']))
                        {
                            $apresentado = "off";
                        }

                        else
                        {
                            $apresentado = $_POST['apresentado'];  
                        }
                
                        if(!isset($_POST['ativo']))
                        {
                            $ativo = "off";
                        }

                        else
                        {
                            $ativo = $_POST['ativo']; 
                        }

                        
                        //Se foi inserido uma imagem, então ele troca
                        if(isset($_FILES['nome_imagem2']['name']))
                        {                           
                            $nome_imagem2 = $_FILES['nome_imagem2']['name'];

                            if($nome_imagem2 != "")
                            {
                                $tmp = explode('.', $nome_imagem2);

                                //isso pega o tipo de arquivo que você está enviando
                                $extensao = end($tmp);

                                $caminho_imagem = $_FILES['nome_imagem2']['tmp_name'];

                                $caminho_destino = "../imagens/".$nome_imagem2;

                                $envio = move_uploaded_file($caminho_imagem, $caminho_destino);

                                //Se falhou em enviar a imagem
                                if($envio == false)
                                {
                                    $_SESSION['envio'] = "<div class='error'>Falhou em enviar a nova imagem</div>";
                                    //header('location: AdicionarCategoria.php');
                                    //die();
                                }

                                if($nome_imagem != "")
                                {
                                    $caminho_remocao = "../imagens/".$nome_imagem;
                                    $remover = unlink($caminho_remocao);
    
                                    if($remover == false)
                                    {
                                        $_SESSION['remover'] = "Não removeu a imagem antiga";
                                    }

                                    else
                                    {
                                        $_SESSION['remover'] = "Removeu imagem antiga com sucesso";
                                    }
                                }                                  
                            }

                            else
                            {
                                $nome_imagem2 = $nome_imagem;
                            }

                            $_SESSION['envio'] = "<div class='sucess'>Deu certo</div>";                          
                        }

                        else
                        {
                            $nome_imagem2 = $nome_imagem;
                        }

                       
                        $sql = "UPDATE tabela_categoria SET
                                       titulo = '$titulo',
                                       nome_imagem = '$nome_imagem2',
                                       apresentado = '$apresentado',
                                       ativo = '$ativo'
                                 WHERE id = '$id'
                        ";
                        
                        
                        $res = mysqli_query($conn, $sql);

                        if($res == true)
                        {
                            $_SESSION['update'] = "Categoria Mudada ";

                            //Redirecionar para a página do Administrador
                            exit(header('location: Categorias.php'));
                            die();
                        }

                        else
                        {
                            $_SESSION['update'] = "Categoria não Mudada";
                        }                         
                    } 
                    
                ?>