-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/09/2024 às 00:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `foto_perfil` text NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `contato` int(11) NOT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adm`
--

INSERT INTO `adm` (`id_admin`, `nome`, `email`, `senha`, `foto_perfil`, `tipo`, `contato`, `data_nasc`) VALUES
(2, 'Giovana Neris', 'Admin@gmail.com', '$2y$10$r0TlgDt5X1y/jtlRdDywn.7XMYQvMu93/MPTOM2pyjMGYS5r2DCXG', '../uploads/download.jfif', 'A', 0, '0000-00-00');

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
-- Estrutura para tabela `atualizacoes_pendentes`
--

CREATE TABLE `atualizacoes_pendentes` (
  `id_atualizacoes_pendentes` int(11) NOT NULL,
  `id_trabalhador` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `foto_perfil` text DEFAULT NULL,
  `foto_trabalho1` text DEFAULT NULL,
  `foto_trabalho2` text DEFAULT NULL,
  `foto_trabalho3` text DEFAULT NULL,
  `foto_banner` text DEFAULT NULL,
  `aprovado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`, `imagem`) VALUES
(1, 'Serviços Doméstico', 'servico-de-limpeza.png'),
(2, 'Reparos e Manutenção', 'repair.png'),
(3, 'Serviços Tecnologicos', 'data-management.png'),
(4, 'Restaurante', 'restaurante.png'),
(5, 'Confeitaria', 'bolo.png'),
(6, 'Serviços para Eventos e Festas', 'festa-de-aniversario.png'),
(7, 'Saude e Beleza', 'secador-de-cabelo.png'),
(8, 'Assesoria Judicial', 'judicial.png'),
(9, 'Educação e Aulas Particulares', 'educacao.png'),
(10, 'Serviços Automotivos', 'servico-automotivo.png'),
(11, 'Artesanato', 'artesanato.png');

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_trabalhador` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `data_comentario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_cliente`, `id_trabalhador`, `comentario`, `data_comentario`) VALUES
(1, 17, 17, 'fggg', '2024-09-18 13:36:16'),
(2, 17, 17, 'lllllll', '2024-09-18 13:50:27'),
(3, 17, 17, 'aa', '2024-09-18 13:53:16'),
(4, 17, 17, 'ghggg', '2024-09-18 13:54:01'),
(5, NULL, 20, 'khhhjhjhj', '2024-09-19 11:32:02'),
(6, NULL, 20, 'hjjhhj', '2024-09-19 11:32:48'),
(7, NULL, 20, 'JHJHJH', '2024-09-19 11:35:30'),
(8, NULL, 20, 'JHJHJH', '2024-09-19 11:35:44'),
(9, NULL, 20, 'JHJHJH', '2024-09-19 11:36:13'),
(10, NULL, 20, 'sx', '2024-09-19 11:37:40'),
(11, NULL, 20, 'jsajkdjs', '2024-09-19 11:38:25'),
(12, NULL, 20, 'sasda', '2024-09-19 11:42:22'),
(13, NULL, 20, 'hhhhh', '2024-09-19 11:45:59'),
(14, NULL, 20, 'huuhuh', '2024-09-19 11:53:12'),
(15, NULL, 20, 'kjkjkj', '2024-09-19 11:55:18'),
(16, NULL, 20, 'xzxz', '2024-09-19 11:57:29');

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
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favorito` int(11) NOT NULL,
  `id_trabalhador` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
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
  `id_area` int(11) NOT NULL,
  `permissao` int(4) NOT NULL,
  `curtidas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `trabalhador`
--

INSERT INTO `trabalhador` (`id_trabalhador`, `nome`, `email`, `senha`, `foto_perfil`, `foto_trabalho1`, `foto_trabalho2`, `foto_trabalho3`, `foto_banner`, `descricao`, `contato`, `data_nasc`, `media_avaliacao`, `tipo`, `status`, `id_categoria`, `id_area`, `permissao`, `curtidas`) VALUES
(15, 'Pato Rog', 'Patinho123@gmail.com', '', '0', 'fundo1.jpg', 'fundo2.jpg', 'testeFundo.jpeg', 'fundoPerfil.png', 'Patoo                                                                        ', '11 99999 8888', '1111-11-11', 0.00, '', '', 1, 3, 0, 0),
(17, 'michele', 'gui@gmail.com', '$2y$10$2GLOHF./f4ZZYWAFFRVt3OmUyBHSs5ZGrwcblOAY2PXOmwHTniWFy', '../uploads/download.jfif', '../uploads/fundo1.jpg', '../uploads/fundo2.jpg', '../uploads/testeFundo.jpeg', '../uploads/fundoPerfil.png', 'sou pobre', '12121212121', '2002-10-16', 0.00, '', '', 8, 6, 0, 0),
(18, 'Maria', 'ma@gmail.com', '$2y$10$RRoK..jGqYKCBkwinAvE3eR9jnxdLJ6zL1ZGH47MniZ8KvrWD0c3a', '../uploads/download.jfif', '', '', '', '', '', '12121212121', '1923-07-05', 0.00, '', '', 10, 5, 0, 0),
(19, 'Paula Pao', 'paula@gmail.com', '$2y$10$NF2UP6tmq3lCAfI2HTtsdufGRVLR0myk4uJx4dJXYTZPNzuokiRH6', '', '', '', '', '', 'Sou a paula teJANDO', '12121212121', '1987-09-25', 0.00, '', '', 11, 7, 0, 0),
(20, 'memphis', 'depay@corinthians.com', '$2y$10$z3vcOAAGGkHLMfBdjHNx4Oh5smLczVUbyNhFsSPicSN.4NhuuWHrm', '../uploads/images.jfif', '', '', '', '', '', '11991829034', '1910-09-01', 0.00, '', '', 8, 4, 0, 0),
(21, 'Maria Silva', 'MariaSilva@gmail.com', '$2y$10$RKPswhmOBsg7lBBmz82VqexnabMXvuQEJmx8813PGCHvApxj14Vve', '../uploads/trabalhadora1.png', '', '', '', '', '', '11912345678', '1982-08-12', 0.00, '', '', 1, 1, 0, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices de tabela `area_atuação`
--
ALTER TABLE `area_atuação`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `atualizacoes_pendentes`
--
ALTER TABLE `atualizacoes_pendentes`
  ADD PRIMARY KEY (`id_atualizacoes_pendentes`),
  ADD KEY `fk_trabalhador` (`id_trabalhador`),
  ADD KEY `fk_area` (`id_area`),
  ADD KEY `fk_categoria` (`id_categoria`);

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
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_trabalhador` (`id_trabalhador`);

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
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `id_trabalhador` (`id_trabalhador`),
  ADD KEY `id_usuario` (`id_cliente`);

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
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `area_atuação`
--
ALTER TABLE `area_atuação`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `atualizacoes_pendentes`
--
ALTER TABLE `atualizacoes_pendentes`
  MODIFY `id_atualizacoes_pendentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trabalhador`
--
ALTER TABLE `trabalhador`
  MODIFY `id_trabalhador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `area_atuação`
--
ALTER TABLE `area_atuação`
  ADD CONSTRAINT `area_atuação_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Restrições para tabelas `atualizacoes_pendentes`
--
ALTER TABLE `atualizacoes_pendentes`
  ADD CONSTRAINT `fk_area` FOREIGN KEY (`id_area`) REFERENCES `area_atuação` (`id_area`),
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_trabalhador` FOREIGN KEY (`id_trabalhador`) REFERENCES `trabalhador` (`id_trabalhador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`id_trabalhador`) REFERENCES `trabalhador` (`id_trabalhador`);

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
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_trabalhador`) REFERENCES `trabalhador` (`id_trabalhador`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

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
