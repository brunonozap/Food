<?php 
    if(!isset($_SESSION))
    {
        session_start();
    }    

    //Checar se o usuário tá logado ou não
    if(!$_SESSION['usuario'])
    {       
        //Redirecionar a página de login com a mensagem
        $_SESSION['no-login-message'] = "<h1>Por favor, logue para acessar</h1>";
        header('location:'.SITE_URL.'codigos/Login.php');
        exit();
    }

    else
    {
        //$_SESSION['no-login-message'] = "<h1>Bem Vindo</h1>";
    }
?>