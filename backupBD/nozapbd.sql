-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jul-2021 às 14:54
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

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
(1, 'No Zap', 'nozap', '0cc175b9c0f1b6a831c399e269772661', 'nozap@gmail.com', '(21) 9987-7665', 'comida2.jpg', 'Barra', 10),
(2, 'No Zap 2', 'nozap2', '0cc175b9c0f1b6a831c399e269772661', 'nozap@gmail.com', '(21) 9987-7665', 'comida2.jpg', 'Barra', 0),
(3, 'No Zap 3', 'nozap3', '0cc175b9c0f1b6a831c399e269772661', 'nozap@gmail.com', '(21) 9987-7665', 'comida2.jpg', 'Barra', 0),
(9, 'teste', 'test', '0cc175b9c0f1b6a831c399e269772661', 'gordo@gmail.com', '(21) 9999-9999', 'NOZAP.jfif.jfif', 'Barra', 10);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tabela_restaurantes`
--
ALTER TABLE `tabela_restaurantes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tabela_restaurantes`
--
ALTER TABLE `tabela_restaurantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
