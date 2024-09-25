-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/09/2024 às 16:34
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
-- Banco de dados: `banco_jundtask`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `foto_perfil` text NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `id_area` int(11) NOT NULL,
  `contato` varchar(11) NOT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `senha`, `foto_perfil`, `tipo`, `status`, `id_area`, `contato`, `data_nasc`) VALUES
(15, 'Maria', 'Maria12@gmail.com', '$2y$10$IQzkVoUhJjeZ1vZP6t5bp.KXuMji2zskEdJB1njGfU5FVIw1xS6jC', '../uploads/download.jfif', '', '', 7, '12121212121', '1981-05-13'),
(16, 'Giovana Neris', 'giovananeris942@gmail.com', '$2y$10$iVzEfkTCsahEhOAkk4NqHeVrjCnJLNtDAL8YvaRdyKeM02PfUNI5u', '../uploads/download.jfif', '', '', 6, '12121212121', '2006-08-28'),
(17, 'louco', 'louco3@gmail.com', '$2y$10$4u9OGrWR.s0OUuFAggJCGueCf9zXqYdCn98jPMx3grria8GGReSiu', '../uploads/images.jpg', '', '', 5, '11111111111', '2000-12-12');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
