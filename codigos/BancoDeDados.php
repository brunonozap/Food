<?php 
    define('SITE_URL', 'localhost'); 
    define('LOCALHOST', 'localhost');
    define('DB_USUARIO', 'root');
    define('DB_SENHA', '');
    define('DB_NOME', 'nozapfoo_nozapbd');

    //define('DB_USUARIO', 'bruno');
    //define('DB_SENHA', 'm3!ZYVJpX9#v');
    //define('SITE_URL', 'https://localhost/NoZapFood/'); 
    //define('DB_NOME', 'https://nozapfood.com.br/nozapfoo_nozapbd');

    mysqli_init();

    $conn = mysqli_connect(SITE_URL, DB_USUARIO, DB_SENHA) or die(mysqli_error($conn)); //conexão com banco de dados, dizendo o endereço dele, o usuário e senha
    $db_selecionado = mysqli_select_db($conn, DB_NOME) or die(mysqli_error($conn));
    
?>