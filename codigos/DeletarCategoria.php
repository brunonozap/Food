<?php 
    include('BancoDeDados.php');
    //include('ChecarLogin.php');
    //Pegar o ID do administrador selecionado
    $id = $_GET['id'];
    $nome_imagem = $_GET['nome_imagem'];      
    
    //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
    $sql = "DELETE FROM tabela_categoria WHERE
                        id='$id' and nome_imagem='$nome_imagem' ";

    echo $sql;

    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['remove'] = "Categoria Deletada com Sucesso";

        header("location: CategoriaAdministrador.php");
    }
?>

