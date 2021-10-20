<?php 
    if(!isset($_SESSION))
    { 
        session_start();
    }
    
    include('BancoDeDados.php');
    include('ChecarLogin.php');
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Painel de Controle</title>
        <link rel="stylesheet" href="../css/painelcontrole.css">
    </head>

    <body>
        <section class = "navbar">
            <div class="container-geral">
                <div id="add-restaurante-Fundo"> 				
                    
                <nav class="nav-bar">
                    <div class="logo">     
                        <a href="index.php" title="Logo">
                            <img src="../imagens/NozapBranco.png" alt="Logo NoZapFood" class="img-responsive">
                        </a>                
                    </div>

                    <div class="cabeca">
                        <ul id="links">
                            <li><a href="index.php">Página Inicial</a></li> |

                            <?php if(isset($_SESSION['nome_restaurante']) != null) { ?>
                            <li><a href="CategoriasAdministrador.php">Categoria</a></li> |
                            <?php }else{ ?>
                            <li><a href="CategoriasCliente.php">Categoria</a></li> |
                            <?php } ?>

                            <?php if(isset($_SESSION['nome_restaurante']) != null) {?>
                            <li><a href="GerenciadorComidas.php">Comidas</a></li> |<?php }else{?>
                            <li><a href="Comidas.php">Comida</a></li> | <?php }?>

                            <li><a href="AtualizarSenhaCliente.php">Mudar Senha</a></li> |
                            <li><a href="ListaRestaurantes.php">Restaurantes</a></li> |

                            <?php if(isset($_SESSION['nome_restaurante'])) {?>    
                            <li><a href="PedidosAdministrador.php">Pedidos</a></li> |
                            <?php }else{?>
                            <li><a href="PedidosCliente.php">Pedidos</a></li> |
                            <?php }?>

                            <?php if(isset($_SESSION['id'])) {?>    
                            <li><a href="PagamentoOnline.php">Pagamento Online</a></li> |
                            <?php }?>             

                            <?php if(isset($_SESSION['nome_restaurante']) != null) { ?>
                            <li><a href="Administradores.php">Administrador</a></li> |
                            <li><a href="Clientes.php">Clientes</a></li> |
                            <?php } ?>
                            
                            <li><a href="Logout.php">Sair</a></li>
                        </ul>
                    </div>
                </nav>

                <div class="bem_vindo">        
                    <img class= "imagem_bemvindo" src = "../imagens/Fotos-icones/icone_painelcontrole.png"/> 
                    <h1>Painel de Controle</h1>
                    <h1>Bem vindo 

                        <?php 
                        
                        if(isset($_SESSION['nome_restaurante']) != null)
                        {
                            echo $_SESSION['nome_restaurante']; 
                        }

                        /*if(isset($_SESSION['bairro']) != null)
                        {
                            echo $_SESSION['bairro']; 
                        }*/

                        else
                        {
                            echo $_SESSION['nome'];
                        }

                        
                        ?>
                    </h1>
                </div>
                
                </div>
            </div>
        </section>
                           


        <div class="footer-rodape-baixo"><br>
            <img src="../imagens/NozapBranco.png" style="width:15%"/>
            <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>
        </div> <!-- Footer-rodapé-Baixo -->

    </body>
</html>