<?php 
    //define('SITE_URL', 'https://localhost/NoZapShop'); //No%20Zap%20Shop
    define('SITE_URL', 'https://localhost/No-Zap-Food');
    session_start();
    //Encerrar a sessão
    session_destroy();

    //$_SESSION['usuario'] = null;

    //Redirecionar para a página principal
    header('location:'.SITE_URL.'/codigos/Login.php');
    exit();
?>