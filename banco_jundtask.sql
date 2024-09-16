-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/09/2024 às 17:11
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
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`) VALUES
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
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `senha`, `foto_perfil`, `tipo`, `status`) VALUES
(5, '', '', '', '', '', ''),
(6, 'Mateus', '1234', 'camelo@etec.sp.gov.br', '', '', ''),
(7, 'fernando', 'fernandomalvado@gmail.com', '777', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_publicacao` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_comentario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversas`
--

CREATE TABLE `conversas` (
  `id_conversa` int(11) NOT NULL,
  `id_trabalhador` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id_mensagem` int(11) NOT NULL,
  `id_conversa` int(11) NOT NULL,
  `id_remetende` int(11) NOT NULL,
  `id_destinatario` int(11) NOT NULL,
  `data_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mensagem` int(11) NOT NULL
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
  `foto_trabalho1` text NOT NULL,
  `foto_trabalho2` text NOT NULL,
  `foto_trabalho3` text NOT NULL,
  `foto_banner` text NOT NULL,
  `descricao` text NOT NULL,
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

INSERT INTO `trabalhador` (`id_trabalhador`, `nome`, `email`, `senha`, `foto_perfil`, `foto_trabalho1`, `foto_trabalho2`, `foto_trabalho3`, `foto_banner`, `descricao`, `contato`, `data_nasc`, `media_avaliacao`, `tipo`, `status`, `id_categoria`, `id_area`) VALUES
(4, 'Giovana', 'giovana@gmail.com', '123', '../img/FotoTesteMuie.png', '', '', '', '0', 'faço serviço domestico a mais de 5 anos', '123123123', '0000-00-00', 5.00, '', '', 1, 2),
(6, 'Guilherme', 'gui@gmail.com', '123456', '../uploads/download.jpg', '', '', '', '0', 'blakfjbgalfkjblfkbjaofibh', '21321321321321', '0000-00-00', 9.99, '', '', 1, 2),
(7, 'Pablo', 'pablo@gmail.vom', '123', '', '', '', '', '0', 'fasso koizas', '11 999999 8888', '2004-08-03', 1.00, '', '', 1, 2),
(15, 'Pato Rogério da Silva Junior', 'Patinho123@gmail.com', '$2y$10$I5NP99ROmwp36405wohCxOWRzcikOBp8a7yJQbiIZD9JJN3WZhAKy', 'teste.jpeg', 'fundo1.jpg', 'fundo2.jpg', 'testeFundo.jpeg', 'fundoPerfil.png', 'Patoo                                                                        ', '11 99999 8888', '1111-11-11', 0.00, '', '', 11, 7);

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
  ADD PRIMARY KEY (`id_categoria`);

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
  ADD KEY `id_publicacao` (`id_publicacao`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `conversas`
--
ALTER TABLE `conversas`
  ADD PRIMARY KEY (`id_conversa`),
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
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id_mensagem`),
  ADD KEY `id_conversa` (`id_conversa`),
  ADD KEY `id_remetende` (`id_remetende`),
  ADD KEY `id_destinatario` (`id_destinatario`);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conversas`
--
ALTER TABLE `conversas`
  MODIFY `id_conversa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id_curtida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  MODIFY `id_trabalhador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `area_atuação`
--
ALTER TABLE `area_atuação`
  ADD CONSTRAINT `area_atuação_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_publicacao`) REFERENCES `comentarios` (`id_comentario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `comentarios` (`id_comentario`);

--
-- Restrições para tabelas `conversas`
--
ALTER TABLE `conversas`
  ADD CONSTRAINT `conversas_ibfk_1` FOREIGN KEY (`id_trabalhador`) REFERENCES `conversas` (`id_conversa`),
  ADD CONSTRAINT `conversas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `conversas` (`id_conversa`);

--
-- Restrições para tabelas `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`id_trabalhador`) REFERENCES `trabalhador` (`id_trabalhador`);

--
-- Restrições para tabelas `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`id_conversa`) REFERENCES `mensagens` (`id_mensagem`),
  ADD CONSTRAINT `mensagens_ibfk_2` FOREIGN KEY (`id_remetende`) REFERENCES `mensagens` (`id_mensagem`),
  ADD CONSTRAINT `mensagens_ibfk_3` FOREIGN KEY (`id_destinatario`) REFERENCES `mensagens` (`id_mensagem`);

--
-- Restrições para tabelas `trabalhador`
--
ALTER TABLE `trabalhador`
  ADD CONSTRAINT `trabalhador_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `trabalhador_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `area_atuação` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
