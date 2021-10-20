<?php

    include('BancoDeDados.php');

    //Pegar o id do Administrador que será excluído
    $id = $_GET['id'];

    //Criar uma Query para deletar o administrador
    $sql = "DELETE FROM tabela_restaurantes WHERE id=$id";

    //Executar a Query
    $res = mysqli_query($conn, $sql);

    //Checar se a Query foi executada com sucesso
    if($res == true)
    {
        $_SESSION['delete'] = "<div class = 'success'> Administrador Deletado. </div> ";
        header('location: Administradores.php');
    }

    else
    {
        $_SESSION['delete'] = "<div class = 'error'>Administrador não Deletado</div>";
        header('location: Administradores.php');
    }

    //Redirecionar para a página de gerenciamento de administrador com a mensagem de sucesso
?>