<?php 
    if(!isset($_SESSION))
    { 
        session_start();
    }

   include('BancoDeDados.php');
?>

<script>
    /*function EsqueceuSenha(url)
    {
        Let ajax = new XMLHttpRequest();
        ajax.open('GET', url); //'EsqueciSenha.php'
        ajax.send();
    }*/
</script>

<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        <link rel="stylesheet" href="../css/login.css"/>
        <title>Login - No Zap Food</title>
    </head>

    <body>

    <?php 
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
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
                        <li><a href="">Restaurante</a></li>
                        <li><a href="Administradores.php">Administradores</a></li>
                    </ul>
                </div> <!-- Cabeca -->
            </nav>
            
            <div class="formulario-geral">
                <div class = "login">
                    <form action="" method="POST">
                    <h1 class = "text-center">Login</h1>
                    <br></br>
                        <p><input type = "text" name = "usuario"  placeholder = "Insira seu Usuário"></p>

                        <p><input type = "password" name = "senha"  placeholder = "Insira sua Senha"></p>
                        
                        <input type="radio" name = "esqueceu_senha" class = "radio_esqueceu" 
                        onclick = "EsqueceuSenha('EsqueciSenha.php')">  
                
                        <label class="esqueceu_senha">Esqueceu sua Senha?</label>
                        <input type = "submit" name = "submit"  value = "Entrar">
                        <input type = "submit" name = "criar_usuario" value = "Criar Usuario">  
                        <input type = "submit" name = "criar_restaurante" value = "Criar Restaurante">                            
                    </form> 
                </div> <!--Login-->
            </div> <!--add-restaurante-Fundo--> 
        </div><!-- Container-Geral-->
    <div class="footer-rodape-baixo"><br>
<img src="../imagens/NozapBranco.png" style="width:15%"/>
<span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>

</div> <!-- Footer-rodapé-Baixo -->

    </body>
</html>


<?php 
    
    //Checar se o botão submit foi clicado ou não
    if(isset($_POST['submit']))
    {        
        //Pegar todos os dados do login no formulário
        $usuario = $_POST['usuario'];
        $senha = md5($_POST['senha']);

        //Checar se o usuário e senha existem ou não na tabela de restaurantes e de usuarios
        $sql_restaurante = "SELECT * FROM tabela_restaurantes WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_usuario = "SELECT * FROM tabela_usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        
        //Executar a Query
        $res = mysqli_query($conn, $sql_restaurante);
        $res2 = mysqli_query($conn, $sql_usuario);

        //Conta o número de linhas e verificar se o usuário existe ou não
        $total_linhas = mysqli_num_rows($res);
        $total_linhas2 = mysqli_num_rows($res2);

        //se pelo menos existe 1 administrador com esse usuario e senha, ele loga 
        if($total_linhas == 1)
        {
            if(!isset($_SESSION))
            { 
                session_start();
            }

            $sql_restaurante2 = "SELECT * FROM tabela_restaurantes WHERE usuario = '$usuario' AND senha = '$senha'";
            $res2 = mysqli_query($conn, $sql_restaurante2);
            $total_linhas2 = mysqli_num_rows($res2);
            $linhas = mysqli_fetch_assoc($res2);

            //Tem usuário no banco de dados
            $_SESSION['login'] =  "<div class = 'success'>Logado com Sucesso</div>";
            $_SESSION['id_restaurante'] = $linhas['id'];
            $_SESSION['nome_restaurante'] = $linhas['nome_restaurante'];
            $_SESSION['usuario'] = $usuario; 
            $_SESSION['bairro'] = $linhas['bairro'];
            //Para checar se o usuário está logado ou não e deslogar caso esteja em estado unset

            //Redirecionar para a página de Controle          
            header('location:PainelControle.php');
        }

        else if($total_linhas2 == 1)
        {
            if(!isset($_SESSION))
            { 
                session_start();
            }

            $sql_usuario2 = "SELECT * FROM tabela_usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
            $res2 = mysqli_query($conn, $sql_usuario2);
            $total_linhas2 = mysqli_num_rows($res2);
            $linhas = mysqli_fetch_assoc($res2);

            //Tem usuário no banco de dados
            $_SESSION['login'] =  "<div class = 'success'>Logado com Sucesso</div>";
            $_SESSION['id'] = $linhas['id'];
            $_SESSION['nome'] = $linhas['nome'];
            $_SESSION['telefone'] = $linhas['telefone'];
            $_SESSION['email'] = $linhas['email'];
            $_SESSION['usuario'] = $usuario; 
            $_SESSION['bairro'] = $linhas['bairro'];

            //Redirecionar para a página de Controle          
            header('location:PainelControle.php');
        }

        else
        {
            $_SESSION['login'] =  "<div class = 'error'>Falha ao Logar</div>";
            $_SESSION['no-login-message'] = "<div class = 'error'>Por favor, logue para acessar</div>";

            //Redirecionar para a página inicial
            header('location:Login.php');
        }

    }

    else if(isset($_POST['criar_restaurante']))
    {
        header('location:AdicionarRestaurante.php');
    }

    else if(isset($_POST['criar_usuario']))
    {
        header('location:AdicionarUsuario.php');
    }

    if(isset($_POST['esqueceu_senha']))
    {
        header('location:EsqueceuSenha.php');
    }

?>