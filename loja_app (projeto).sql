-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/09/2026 às 22:14
-- Versão do servidor: 8.4.7
-- Versão do PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja_app`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `category`
--

INSERT INTO `category` (`id`, `name`, `dateCreate`, `dateModified`) VALUES
(1, 'Smartphone', '2026-05-14 00:31:10', NULL),
(2, 'Notebook', '2026-05-14 00:31:10', NULL),
(3, 'Desktop', '2026-05-14 00:31:10', NULL),
(4, 'Console', '2026-05-14 00:31:10', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

DROP TABLE IF EXISTS `contatos`;
CREATE TABLE IF NOT EXISTS `contatos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assunto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_envio` datetime NOT NULL,
  `status` enum('pendente','respondido','ignorado') COLLATE utf8mb4_unicode_ci DEFAULT 'pendente',
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_data` (`data_envio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `email`, `assunto`, `mensagem`, `data_envio`, `status`) VALUES
(1, 'Teste', 'teste@test.com', 'Assunto Teste', 'Mensagem teste', '2026-06-10 18:12:54', 'pendente'),
(2, 'Teste', 'teste@test.com', 'Assunto Teste', 'Mensagem teste', '2026-06-10 18:13:08', 'pendente'),
(3, 'Nicollas Vinicius', 'viniciusnicollas59@gmail.com', 'Ta pica o site', 'aaaaaaaaa', '2026-06-10 21:22:02', 'pendente'),
(4, 'Nicollas', 'viniciusnicollas59@gmail.com', 'Ta pica o site', 'dnv', '2026-06-10 21:27:27', 'pendente'),
(5, 'Nicollas Vinicius', 'lith123htr@gmail.com', 'slk', 'aaaaaaaaaaa', '2026-06-10 22:49:35', 'pendente'),
(6, 'Nicollas', 'viniciusnicollas59@gmail.com', 'Ta pica o site', 'aaaaaaaaaaaa', '2026-06-10 22:49:54', 'pendente'),
(7, 'Nicollas', 'viniciusnicollas59@gmail.com', 'AAAAAAAAAAAAA', 'AAAAAAAAAAAAAAA', '2026-06-10 23:55:19', 'pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `department`
--

INSERT INTO `department` (`id`, `name`, `dateCreate`, `dateModified`) VALUES
(1, 'Processadores', '2026-04-01 23:44:43', NULL),
(2, 'Placa De Video', '2026-04-01 23:44:43', NULL),
(3, 'Armazenamento', '2026-04-01 23:49:25', NULL),
(4, 'Fontes', '2026-04-01 23:49:25', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `datecreate` datetime NOT NULL,
  `datemodified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `newsletter`
--

INSERT INTO `newsletter` (`id`, `name`, `email`, `message`, `datecreate`, `datemodified`) VALUES
(4, 'Remilton Silva', 'remiltonsilva@outlook.com', 'Ksjdbflgwheflkg', '2026-05-08 01:43:07', NULL),
(6, 'Rave', 'gamerave69@gmail.com', 'Aaaaaaaaaaaaaaa', '2026-06-10 20:51:59', NULL),
(9, 'Nicollas', 'viniciusnicollas59@gmail.com', 'AAAAA', '2026-06-10 23:53:56', NULL),
(10, 'Angelys', 'angelysdelgado08@gmail.com', 'Ola', '2026-06-11 00:29:27', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` int NOT NULL,
  `image` text COLLATE utf8mb4_general_ci,
  `image2` text COLLATE utf8mb4_general_ci NOT NULL,
  `image3` int NOT NULL,
  `sale` int DEFAULT '0',
  `sales_quantity` int DEFAULT NULL,
  `slug` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL,
  `department_id` int NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `amount`, `image`, `image2`, `image3`, `sale`, `sales_quantity`, `slug`, `category_id`, `department_id`, `dateCreate`, `dateModified`) VALUES
(24, 'Placa de Vídeo ASROCK Radeon RX7600', 'Placa boa', 1250.00, 5, 'Placa_de_Video_ASROCK_Radeon_RX7600.jpg', '', 0, 20, 5, 'placa-de-video-asrock-radeon-rx7600', 3, 2, '2026-06-10 23:07:00', NULL),
(25, 'Processador AMD Ryzen 5600GT', 'processador top', 600.00, 5, 'Processador_AMD_Ryzen_5_5600GT.webp', '', 0, 30, 10, 'processador_amd_ryzen_5_5600gt', 3, 1, '2026-06-10 23:37:58', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModfied` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `cpf`, `email`, `password`, `active`, `dateCreate`, `dateModfied`) VALUES
(1, 'Francisco Carlos Vieira', '96095108764', 'francisco.carlos.vieira@michaelpage.com.br', '$2y$10$DEpNPg77Y9eta09.a9/.KuimnvoCi/SCzVQLawjAJSkzN5POF1oQy', 1, '2026-04-01 00:12:13', NULL),
(2, 'Geraldo Bruno Campos', '95774264688', 'geraldo.bruno.campos@netsinf.com.br', '$2y$10$DEpNPg77Y9eta09.a9/.KuimnvoCi/SCzVQLawjAJSkzN5POF1oQy', 0, '2026-04-01 00:20:33', NULL),
(3, 'Aline Rosângela Corte Real', '04795248150', 'aline-cortereal94@wsiconsultores.com.br', '$2y$10$DEpNPg77Y9eta09.a9/.KuimnvoCi/SCzVQLawjAJSkzN5POF1oQy', 0, '2026-04-01 00:21:29', NULL);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
