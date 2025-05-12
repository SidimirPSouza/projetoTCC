-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/03/2025 às 20:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdcantina`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbprodutos`
--

CREATE TABLE `tbprodutos` (
  `codproduto` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `preco` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `categoria` varchar(10) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbprodutos`
--

INSERT INTO `tbprodutos` (`codproduto`, `nome`, `preco`, `qtde`, `categoria`, `foto`) VALUES
(29, 'coxinha', 100, 50, 'salgados', 'img_672df2427762c5.32349300.jpg'),
(30, 'coxinha', 10, 50, 'salgados', 'img_672e1abf1ee669.83441375.jpg'),
(31, 'coxinha', 10, 50, 'salgados', 'img_672e1fb1522e63.28950221.jpg'),
(32, 'coxinha', 10, 50, 'salgados', 'img_672e2030188e45.77493051.jpg'),
(35, 'cone', 10, 1, 'doces', 'img_6732241d5413b9.65347023.jpg'),
(38, 'delicia', 13, 20, 'salgados', 'img_67e99170056c66.08023422.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `nome` varchar(50) NOT NULL,
  `turma` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbusuarios`
--

INSERT INTO `tbusuarios` (`nome`, `turma`, `email`, `senha`) VALUES
('sid', '3b1', 'sidimirh@hotmail.com', '1234'),
('duda', '2b3', 'sidimirh@hotmail.com', '1234'),
('will', '1a1', 'gsg@ttt.f', '123'),
('will', '1a1', 'gsg@ttt.f', '123'),
('will', '1a1', 'gsg@ttt.f', '123'),
('sid', '1a2', 'sidizin@etec.sp', '1234'),
('otavio', '1a3', 'macaco@gmail', '1234'),
('cone', '1a2', 'gsg@ttt.f', '1234'),
('fanta uva', '3b1', 'sidizin@etec.sp', 'sex'),
('sid', '3b1', 'sidih@hotmail.com', 'sidikiki'),
('duda', '5b3', 'gsg@ttt.f', '1234'),
('duda', '5b3', 'gsg@ttt.f', '1234'),
('sid', '3b1', 'sidimirh@hotmail.com', '1234'),
('everton', '2a1', 'juningrau@gmail.com', '1234'),
('everton', '2a1', 'juningrau@gmail.com', '1234'),
('everton', '2a1', 'juningrau@gmail.com', '1234'),
('cone', '3b1', 'gsg@ttt.f', '1234'),
('cone', '3b1', 'gsg@ttt.f', '1234'),
('cone', '3b1', 'gsg@ttt.f', '1234'),
('cone', '1a2', 'sidizin@etec.sp', '4'),
('cone', '1a2', 'sidizin@etec.sp', '4'),
('eu', '1a2', 'kkkk@gmail.com', ''),
('sid', 'nbh', 'njjjj@gmail.com', ''),
('duda ', '1a1', 'mduda@gmail.com', ''),
('sid', '3b1', 'aaaa@gmail.com', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbprodutos`
--
ALTER TABLE `tbprodutos`
  ADD PRIMARY KEY (`codproduto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbprodutos`
--
ALTER TABLE `tbprodutos`
  MODIFY `codproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
