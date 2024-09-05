-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/09/2024 às 14:10
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

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
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `foto_perfil` text NOT NULL,
  `tipo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `area_atuação`
--

CREATE TABLE `area_atuação` (
  `id_area` int(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `area_atuação`
--

INSERT INTO `area_atuação` (`id_area`, `cidade`, `id_categoria`) VALUES
(1, 'Cabreuva', NULL),
(2, 'Campo Limpo Paulista', NULL),
(3, 'Itupeva', NULL),
(4, 'Jarinu', NULL),
(5, 'Jundiai', NULL),
(6, 'Limeira', NULL),
(7, 'Varzea Paulista', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Serviços Doméstico'),
(2, 'Reparos e Manutenção'),
(3, 'Serviços Tecnologicos'),
(4, 'Restaurante'),
(5, 'Confeitaria'),
(6, 'Serviços para Eventos e Festas'),
(7, 'Saude e Beleza'),
(8, 'Assesoria Judicial'),
(9, 'Educação e Aulas Particulares'),
(10, 'Serviços Automotivos'),
(11, 'Artesanato');

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
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `senha`, `foto_perfil`, `tipo`, `status`, `id_area`) VALUES
(5, '', '', '', '', '', '', 0),
(6, 'Mateus', '1234', 'camelo@etec.sp.gov.br', '', '', '', 0),
(7, 'fernando', 'fernandomalvado@gmail.com', '777', '', '', '', 0),
(8, 'giovana', 'giovana@gmail.com', '$2y$10$Pc5kcoujZ56k4WLYqVybvuv77gvKg/INahEt9CsuehUTqw5P5KjJi', '../uploads/Captura de tela 2024-02-29 151819.png', '', '', 2),
(9, 'giovana', 'giovana@gmail.com', '$2y$10$SPXvFh0GWg5MQFiUziQWVexJQEEMZTb0xZsrGWDg5ugrlNSy/a9wa', '../uploads/download.jpg', '', '', 7),
(10, 'giovana', 'giovana@gmail.com', '$2y$10$/kzE4loXRIa.hT60FbIEtODpNAQMbejyQ5lUkDoPVLVSR3b78n/OW', '../uploads/download.jpg', '', '', 7),
(11, 'giovana', 'giovana@gmail.com', '$2y$10$CwytAyTThjtS.1Edm4ynr.tti5C9kVPuUWudkqWa6ImZg.xjhANTy', '../uploads/download.jpg', '', '', 7),
(12, 'giovana', 'giovana@gmail.com', '$2y$10$dCqrzSvVTk8PTwCjwBadaeO.pVSo3koQHJ4T0V58JH54fkAyQJkoO', '../uploads/download.jpg', '', '', 7),
(13, 'giovana', 'giovana@gmail.com', '$2y$10$jl/kJC9xEwF5GhN9s2jp/uRVQOdXylOWuzr99g542P/5T9L9a0tUy', '../uploads/download.jpg', '', '', 7),
(14, 'giovana', 'giovana@gmail.com', '$2y$10$ScIqSSSTsqwYtlq3l6g2j.MJ1RJnfI0ufoJeQCbX28YcSfJMtGTkq', '../uploads/download.jpg', '', '', 7),
(15, 'giovana', 'giovana@gmail.com', '$2y$10$yxJ.d/LNWjtGrRiq7HM1AeydimO..jC.YLo2.n5C3bblSGueGgYSS', '../uploads/download.jpg', '', '', 7),
(16, 'giovana', 'giovana@gmail.com', '$2y$10$/6PL69P43LoC0GgEnYt7KufdYSuXWJMAj6PiRU2a3n3Vyu1ItNNGS', '../uploads/download.jpg', '', '', 7),
(17, 'giovana', 'giovana@gmail.com', '$2y$10$76M.sgceAkt1O2gvvw6mi.WA65e3JfwtsbPTwkU7EozI/Zri1PadS', '../uploads/download.jpg', '', '', 7),
(18, 'giovana', 'giovana@gmail.com', '$2y$10$sK7WnFJ/Zn7.hIRrS3RBSOPNXJG/rSOTw3Ugn8bjOtJc4kOrYv6GG', '../uploads/download.jpg', '', '', 1),
(19, 'giovana', 'giovana@gmail.com', '$2y$10$9f/dW30p8G9pcleXkv/zpub/ZmlR0eAH5TspUXKJxyS5ZzutNzis2', '../uploads/download.jpg', '', '', 1),
(20, 'giovana', 'giovana@gmail.com', '$2y$10$doHRO9QLMjYQmWOWkSJwBuzXf0N7gKUJ.ZwHiAvpRaWCbAU6.r/DK', '../uploads/download.jpg', '', '', 1),
(21, 'giovana', 'giovana@gmail.com', '$2y$10$XAx.eva5d5iB4w8pGhUzGueg2karYr0F0gx3.N47ZtWGkFU.XClGi', '../uploads/download.jpg', '', '', 1),
(22, 'mamama', 'mamama@gmail.com', '$2y$10$8UQzy64EeGfxzCeVAoH/WOpgYcsKhCMoNTcgnweRs.2WpLlxo55gK', '../uploads/download.jpg', '', '', 2),
(23, 'lucas', 'giovana@gmail.com', '$2y$10$30UI6V0QbF6d9x3Za2h/EepwTAzxH8lC.sT41hwzQAqNXtTbqwMKi', '../uploads/download.jpg', '', '', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_trabalhador` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id_curtida` int(11) NOT NULL,
  `data_curtida` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_trabalhador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `trabalhador`
--

CREATE TABLE `trabalhador` (
  `id_trabalhador` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `foto_perfil` text NOT NULL,
  `desc` text NOT NULL,
  `curtidas` int(11) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `data_nasc` date NOT NULL,
  `media_avaliacao` decimal(3,2) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `trabalhador`
--

INSERT INTO `trabalhador` (`id_trabalhador`, `nome`, `email`, `senha`, `foto_perfil`, `desc`, `curtidas`, `contato`, `data_nasc`, `media_avaliacao`, `tipo`, `status`, `id_categoria`, `id_area`) VALUES
(4, 'giovana', 'giovana@gmail.com', '123', '', 'faço serviço domestico a mais de 5 anos', 0, '123123123', '0000-00-00', 5.00, '', '', 1, 2),
(6, 'Guilherme', 'gui@gmail.com', '123456', '', 'blakfjbgalfkjblfkbjaofibh', 0, '21321321321321', '0000-00-00', 9.99, '', '', 1, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices de tabela `area_atuação`
--
ALTER TABLE `area_atuação`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_trabalhador` (`id_trabalhador`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`id_curtida`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_trabalhador` (`id_trabalhador`);

--
-- Índices de tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  ADD PRIMARY KEY (`id_trabalhador`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_area` (`id_area`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `area_atuação`
--
ALTER TABLE `area_atuação`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id_curtida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  MODIFY `id_trabalhador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `area_atuação`
--
ALTER TABLE `area_atuação`
  ADD CONSTRAINT `area_atuação_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_trabalhador`) REFERENCES `trabalhador` (`id_trabalhador`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Restrições para tabelas `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`id_trabalhador`) REFERENCES `trabalhador` (`id_trabalhador`);

--
-- Restrições para tabelas `trabalhador`
--
ALTER TABLE `trabalhador`
  ADD CONSTRAINT `trabalhador_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `trabalhador_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `area_atuação` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
