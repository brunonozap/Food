<?php 

    include('BancoDeDados.php');
    //include('ChecarLogin.php');

    session_start(); 

    ob_start();

    include('..\vendor\autoload.php');

    use Ipag\Ipag;
    use Ipag\Classes\Authentication;
    use Ipag\Classes\Endpoint;
    use Ipag\Classes\Enum\Method;
    use Ipag\Classes\Enum;
    use Ipag\Classes\Enum\PaymentStatus;

    //$ipag = new Ipag(new Authentication('brunonozap@gmail.com', 'A07A-966B62FD-9B844FE1-BA8511FF-9570'), Endpoint::SANDBOX);
    $ipag = new Ipag(new Authentication('diogo.f3x@hotmail.com', '83A4-015554D2-69860FDB-9E2F6FD4-E1D2'), Endpoint::PRODUCTION);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <link rel="stylesheet" href="../css/cartao_credito.css"/>
		<title>Pagamento Online</title>
	</head>
    
	<body> 
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Mostra mensagem de sessão
                unset($_SESSION['add']); //Remove mensagem de sessão
            }
        ?>

    <div class="container-geral">
        <div id="add-restaurante-Fundo"> 
            <nav class="nav-bar">

                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="../imagens/NozapBranco.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                </div>
                 <!-- Logo -->

				<div class="cabeca">
					<ul id="links">
						<li><a href="../codigos/ListaRestaurantes.php">Restaurante</a></li> |
						<li><a href="Logout.php">Sair</a></li>
					</ul>
				</div> <!--Cabeca--> 
            </nav> 
                        
            <?php 
                if(isset($_SESSION['Pagamento']))
                {
                    echo $_SESSION['Pagamento'];
                    unset($_SESSION['Pagamento']);
                }
            ?>
            
                <div class="formulario-geral">                      
                    <form id="formulario" action="" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <legend>
                                <h1 class="titulo">Cartão de Crédito</h1>
                            </legend>

                            <legend>Nome Completo:</legend> 
                            <input type="text" name="nome_completo" placeholder="Digite o seu Nome" required>
                                           
                            <legend>Logradouro: </legend>
                            <input type="text" name="endereco" placeholder="Digite o seu Logradouro" required>
                
                            <legend>Numero: </legend>
                            <input type="number" name="numero_endereco" placeholder="Digite o seu Número" required>
                         
                            <legend>Bairro: </legend>
                            <input type="text" name="bairro" placeholder="Digite o seu Bairro" required>
                                         
                            <legend>Cidade: </legend>
                            <input type="text" name="cidade" placeholder="Digite a sua Cidade" required>
                                     
                            <legend>Estado: </legend>
                            <input type="text" name="estado" placeholder="Digite o seu Estado" required>
            
                            <legend>CEP: </legend>
                            <input type="text" name="CEP" placeholder="Digite o seu CEP" required>
        
                            <legend>Data Aniversário: </legend>
                            <td><input type="text" name="data_aniversario" placeholder="ex: 1995-08-15 " required></td>
                
                            <legend>Numero Cartão: </legend>
                            <input type="text" name="numero_cartao" placeholder="XXXXXXXXXXXXXXXX" required>

                            <legend>Bandeira: </legend>
                            <td>                   
                                <select name="Bandeira" class = "Bandeira" required>
                                    <option value="" disabled selected>Filtrar por Bandeira</option>
                                    <option value="visa">VISA</option>
                                    <option value="mastercard">MASTERCARD</option>
                                    <option value="diners">DINERS</option>
                                    <option value="elo">ELO</option>
                                </select>                    
                            <td>
     
                            <legend>Mês Expiração: </legend>
                            <input type="text" name="mes_cartao" placeholder="XX" required>
    
                            <legend>Ano Expiração: </legend>
                            <input type="text" name="ano_expiracao" placeholder="XXXX" required>
        
                            <legend>Código Verificador: </legend>
                            <input type="text" name="cvc" placeholder="XXX" required>
                            
                            <input type="submit" name="submit" value="Pagar" class="btn-secondary" required>
            
                        </fieldset>
                    </form>
                </div> <!-- Formulario-Geral -->
        </div> <!-- add-restaurante-img -->
    </div> <!-- Container-Geral-->

    <div class="footer-rodape-baixo"><br>
        <img src="../imagens/NozapBranco.png" style="width:15%"/>
    <span>© Copyright 2020 - ZapFood - Todos os direitos reservados!</span>

</div> <!-- Footer-rodapé-Baixo -->

    </body>
    </html>


<?php 
    //Aqui ele processa o valor do formulário e salva no banco de dados
    if(isset($_POST['submit'])) // Ele verifica se o botão foi clicado ou não
    {

        //Botão clicado, agora vou ter que pegar as informações no name do formulário
        $nome = $_POST['nome_completo'];
        $telefone = $_SESSION['telefone'];
        $email = $_SESSION['email'];
        $data_aniversario = $_POST['data_aniversario'];
        $logradouro = $_POST['endereco'];
        $logradouro_numero = $_POST['numero_endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $cep = $_POST['CEP'];
        $bandeira = $_POST['Bandeira'];

        echo $bandeira;

        $numero_cartao = $_POST['numero_cartao'];
        $mes_expiracao = $_POST['mes_cartao'];
        $ano_expiracao = $_POST['ano_expiracao'];
        $cvc = $_POST['cvc'];

        $cliente = $ipag->customer()
        ->setName($nome)
        ->setTaxpayerId($numero_cartao)
        ->setPhone('21', $telefone)
        ->setEmail($email)
        ->setBirthdate($data_aniversario)
        ->setAddress($ipag->address()
            ->setStreet($logradouro)
            ->setNumber($logradouro_numero)
            ->setNeighborhood($bairro)
            ->setCity($cidade)
            ->setState($estado)
            ->setZipCode($cep)
        );

        /*$cliente_teste = $ipag->customer()
        ->setName('Fulano da Silva')
        ->setTaxpayerId('799.993.388-01')
        ->setPhone('11', '98888-3333')
        ->setEmail('fulanodasilva@gmail.com')
        ->setBirthdate('1989-03-28')
        ->setAddress($ipag->address()
            ->setStreet('Rua Júlio Gonzalez')
            ->setNumber('1000')
            ->setNeighborhood('Barra Funda')
            ->setCity('São Paulo')
            ->setState('SP')
            ->setZipCode('01156-060')
        );*/

       
             
        if(isset($_SESSION['carrinho']))
        {                   
            $contador = 0;

            $produtos = array();

            $total_compra = 0;

            foreach($_SESSION['carrinho'] as $key => $value)
            {                     
                $id_restaurante = $value['id_restaurante']; 
                $titulo = $value['nome_comida'];
                $quantidade = $value['quantidade'];
                $preco = $value['preco'];
                $total = $value['total'];          
                $data_ordem = $value['data_ordem'];
                $estado = $value['estado']; //Em Analise, Preparando, Entregando, Concluido    
                $nome_completo = $value['nome_completo'];
                $telefone = $value['telefone'];
                $email = $value['email'];
                $endereco = $value['endereco'];
                $data_pedido = date("d/m/Y H:m:s");
                $bairro = $value['bairro'];
                $pago = true;
                $id_cliente = $value['id_cliente'];

                if(isset($_SESSION['taxas']))
                {
                    foreach($_SESSION['taxas'] as $key => $taxas)
                    {
                        $total += $taxas['taxa_pedido'];
                    }

                    unset($_SESSION['taxas']);
                }

                $produto = [$titulo, $preco, $quantidade, $id_restaurante];

                $produtos[] = [$titulo, $preco, $quantidade, $id_restaurante];

                $total_compra += $total;
                

                 //Agora tenho que criar um comando SQL para salvar os dados no banco de dados
                 $sql = "INSERT INTO tabela_pedidos SET
                                     comida='$titulo',
                                     preco='$preco',
                                     quantidade='$quantidade',
                                     total='$total',
                                     data_ordem='$data_ordem',
                                     estado='$estado',
                                     nome_cliente='$nome_completo',
                                     contato_cliente='$telefone',
                                     endereco_cliente='$endereco',
                                     email_cliente='$email',
                                     id_restaurante='$id_restaurante',
                                     Pago='$pago',
                                     bairro='$bairro',
                                     id_cliente='$id_cliente'";

                //echo $sql;

                $res = mysqli_query($conn, $sql);       
            }

            unset($_SESSION['carrinho']);

            //echo "Produtos: " + var_dump($produtos);

            $cart = $ipag->cart(...$produtos);

            //echo "Carrinho: ", var_dump($cart);

            /*$creditCard_teste = $ipag->creditCard()
             ->setNumber('4066553613548107')
             ->setHolder('BRUNO FERREIRA')
             ->setExpiryMonth('10')
             ->setExpiryYear('2025')
             ->setCvc('123');                       
             */

            $numero_cartao_teste = "4066553613548107"; //no ambiente de teste só pega esse número

            $creditCard = $ipag->creditCard()
             ->setNumber($numero_cartao)
             ->setHolder($nome)
             ->setExpiryMonth($mes_expiracao)
             ->setExpiryYear($ano_expiracao)
             ->setCvc($cvc);

            if($bandeira == "visa")
            {
                $payment = $ipag->payment() ->setMethod(Method::VISA)
                ->setCreditCard($creditCard);
            }

            else if($bandeira == "mastercard")
            {
                $payment = $ipag->payment() ->setMethod(Method::MASTERCARD)
                ->setCreditCard($creditCard);
            }

            else if($bandeira == "diners")
            {
                $payment = $ipag->payment() ->setMethod(Method::DINERS)
                ->setCreditCard($creditCard);
            }

            else if($bandeira == "elo")
            {
                $payment = $ipag->payment() ->setMethod(Method::ELO)
                ->setCreditCard($creditCard);
            }

            //Regra de Split 1 (com porcentagem %)
            /*$payment->addSplitRule($ipag->splitRule()
            ->setSellerId('c66fabf44786459e81e3c65e339a4fc9')
            ->setPercentage(15)
            ->setLiable(1)
            );

            //Regra de Split 2 (com valor absoluto R$)
            $payment->addSplitRule($ipag->splitRule()
                ->setSellerId('c66fabf44786459e81e3c65e339a4fc9')
                ->setAmount(5.00)
                ->setLiable(1)
            );*/

            $transaction = $ipag->transaction();

            /*$transaction_test = $ipag->transaction();

            $transaction_test->getOrder()
            ->setOrderId(0) //0 $orderId
            ->setCallbackUrl('https://minha_loja.com.br/ipag/callback')
            ->setAmount($total_compra) 
            ->setInstallments(1)
            ->setPayment($payment)
            ->setCustomer($cliente_teste)
            ->setCart($cart);*/
          
            $transaction->getOrder()
            ->setOrderId(0) //0 $orderId
            ->setCallbackUrl('https://minha_loja.com.br/ipag/callback')
            ->setAmount($total_compra) 
            ->setInstallments(1)
            ->setPayment($payment)
            ->setCustomer($cliente)
            ->setCart($cart);
            

            $response = $transaction->execute();

            //$response = $transaction_test->execute();
                       
            //Retornou algum erro?
            if (!empty($response->error))
            {
                //echo "deu erro";
                $_SESSION['Pagamento'] = "Deu erro ao pagar, por favor refaça";
                throw new \Exception($response->errorMessage);
            }

            //Pagamento Aprovado (5) ou Aprovado e Capturado(8) ?
            if (in_array($response->payment->status, [
                PaymentStatus::PRE_AUTHORIZED, PaymentStatus::CAPTURED])) 
            {
                //Faz alguma coisa...
                //echo "deu bom";
                unset($_SESSION['carrinho']);
                header('location: Clientes/Pedidos.php');
                return $response;
            }



             ?> <br><br><?php
       
        }
        /*if($envio==false)
        {
            $_SESSION['envio'] = "<div class='error'>Falhou em enviar a nova imagem</div>";
            header('location: AdicionarCategoria.php');
            die();
        }

        else
        {
            header('location: PainelControle.php');
        }*/
    }
               
?>