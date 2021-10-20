<?php 
    include('BancoDeDados.php');
    //include('ChecarLogin.php');
    //Pegar o ID do administrador selecionado
    $id = $_GET['id'];  
    
    //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
    $sql = "DELETE FROM tabela_pedidos WHERE
                        id='$id'";

    echo $sql;

    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['remove'] = "Categoria Deletada com Sucesso";

        header("location: PedidosAdministrador.php");
    }
?>

