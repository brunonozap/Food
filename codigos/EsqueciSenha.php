<?php 
    namespace nozapfood\public_html;

    if(!isset($_SESSION))
    { 
        session_start();
    }

    ob_start();

    include('BancoDeDados.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'vendor/autoload.php';

   
?>

<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        <link rel="stylesheet" href="css/esqueci_senha.css"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.1">
        <!-- CSS only -->
    
        <link rel="shortcut icon" href="caminhodoarquivo/favicon.ico" />
        <title>Esqueci Senha - No Zap Food</title>
    </head>

    <body>
			
    <div class="container-geral">
        <div id="add-restaurante-Fundo"> 
            <nav class="nav-bar">
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
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
                    <h1 class = "text-center tamanho_textologin">Esqueceu Senha</h1>
             
                        <p><input type = "text" name = "email"  placeholder = "Digite seu E-mail" ></p>

                        <input type = "submit" name = "submit"  value = "Enviar">
                           
                    </form> 
                </div> <!--Login-->
            </div> <!--add-restaurante-Fundo--> 
    </div><!-- Container-Geral-->
    
    <div class="footer-rodape-baixo"><br>
        <img src="imagens/NozapBranco.png" style="width:15%"/>
        <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>
    </div> <!-- Footer-rodapé-Baixo -->

    </body>
</html>


<?php 
    
    //Checar se o botão submit foi clicado ou não
    if(isset($_POST['submit']))
    {        
        
        $mail = new \PHPMailer\PHPMailer\PHPMailer();

        date_default_timezone_set('America/Sao_Paulo');

        $email = $_POST['email'];
        $key = md5(rand(999, 99999));
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        $key = $key . $addKey;
        $nova_senha = rand(000000, 999999);
        $expDate = date("Y-m-d H:i:s", time());

        $sql0 = "SELECT * FROM tabela_usuarios_temporaria";
        $result = mysqli_query($conn, $sql0);

        if($result == false)
        {
            $sql1 = "CREATE TABLE tabela_usuarios_temporaria (
                                email varchar(250) NOT NULL,
                                keyvalue varchar(250) NOT NULL,
                                expDate datetime NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

            $res1 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        }

        $sql2 = "INSERT INTO tabel_usuarios_temporaria (
                             email='$email',
                             keyvalue='$key',
                             expDate='$expDate'";

        $result1 = mysqli_query($conn, $sql2);

        $sql3 = "SELECT id, senha, nome FROM tabela_usuarios WHERE email = '$email'";

        $result2 = mysqli_query($conn, $sql3);

        $linhas = mysqli_fetch_assoc($result2);

        $senha = $linhas['senha'];

        $nome = $linhas['nome'];

        $id = $linhas['id'];

        $email_to = $email;

        $nova_senha_md5 = md5($nova_senha);

        $sql4 = "UPDATE tabela_usuarios SET
                 senha='$nova_senha_md5' WHERE id='$id'";

        $res4 = mysqli_query($conn, $sql4); 

        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'mail.nozapfood.com.br';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@nozapfood.com.br';
        $mail->Password = 'Shopenozap@21';
        $mail->SMTPDebug = 0;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('noreply@nozapfood.com.br', 'NoZap Food');
        $mail->addReplyTo('info@nozapfood.com.br', 'Mailtrap');
        $mail->addAddress($email, $nome);
        //$mail->addAddress('danilobrum03@hotmail.com', 'Danilo');
        //$mail->addCC('brunoferreira378@gmail.com', 'Bruno');

        $mail->Subject = 'Recuperação de senha';

        $mail->isHTML(true);

        $senha = md5($senha);

        $mailContent = "<h1>Sua senha temporária é: $nova_senha</h1>
            <p>No Zap Food - Todos os direitos reservados.</p>";
        $mail->Body = $mailContent;

        if($mail->send())
        {
            echo 'Message has been sent';
        }
        
        else
        {
            echo 'Message could not be sent.';
            echo '<br /><br />Mailer Error: ' . $mail->ErrorInfo;
        }

        //$sql2 = "INSERT INTO tabela_usuarios_temporaria'";
    }

?>