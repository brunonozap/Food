-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jul-2021 às 21:58
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nozapbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_bairros`
--

CREATE TABLE `tabela_bairros` (
  `id` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_categoria`
--

CREATE TABLE `tabela_categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `nome_imagem` varchar(255) NOT NULL,
  `apresentado` varchar(10) NOT NULL COMMENT 'basicamente aqui ele verifica se vai estar apresentado na página da tela principal',
  `ativo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1;

--
-- Extraindo dados da tabela `tabela_categoria`
--

INSERT INTO `tabela_categoria` (`id`, `titulo`, `nome_imagem`, `apresentado`, `ativo`) VALUES
(1, 'Pizza', 'pizza.jpg', '', ''),
(2, 'Hamburguer', 'burger.jpg', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_comida`
--

CREATE TABLE `tabela_comida` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(7,5) NOT NULL,
  `nome_imagem` varchar(255) NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `apresentado` varchar(10) NOT NULL COMMENT 'basicamente diz se a comida ira ser apresentada na página principal',
  `ativo` varchar(10) NOT NULL,
  `id_restaurante` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_pedidos`
--

CREATE TABLE `tabela_pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `comida` varchar(150) NOT NULL,
  `preco` decimal(10,5) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total` decimal(10,5) NOT NULL,
  `data_ordem` datetime NOT NULL,
  `estado` varchar(255) NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `contato_cliente` varchar(255) NOT NULL,
  `endereco_cliente` varchar(255) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `Pago` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_restaurantes`
--

CREATE TABLE `tabela_restaurantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome_restaurante` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `nome_imagem` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `taxa_entrega` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tabela_restaurantes`
--

INSERT INTO `tabela_restaurantes` (`id`, `nome_restaurante`, `usuario`, `senha`, `email`, `telefone`, `nome_imagem`, `bairro`, `taxa_entrega`) VALUES
(1, 'No Zap Food', 'nozapfood', 'a1bcbb8d74a20a24dfa0bbbeaf457f67', 'nozap@hotmail.com', '21 96433-3848', 'VerdeFood.png.png', 'Barra', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_usuarios`
--

CREATE TABLE `tabela_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tabela_categoria`
--
ALTER TABLE `tabela_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tabela_comida`
--
ALTER TABLE `tabela_comida`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tabela_pedidos`
--
ALTER TABLE `tabela_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tabela_restaurantes`
--
ALTER TABLE `tabela_restaurantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tabela_usuarios`
--
ALTER TABLE `tabela_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tabela_categoria`
--
ALTER TABLE `tabela_categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tabela_comida`
--
ALTER TABLE `tabela_comida`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabela_pedidos`
--
ALTER TABLE `tabela_pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabela_restaurantes`
--
ALTER TABLE `tabela_restaurantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tabela_usuarios`
--
ALTER TABLE `tabela_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
