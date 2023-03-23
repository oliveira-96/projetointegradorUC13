CREATE DATABASE `projetox`;

USE `projetox`;

CREATE TABLE `usuarios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL UNIQUE KEY,
  `senha` varchar(100) NOT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `status` TINYINT(1) NULL DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alterado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categorias` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `categoria` varchar(255) DEFAULT NULL UNIQUE KEY,
  `status` TINYINT(1) NULL DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alterado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `artigos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) DEFAULT NULL UNIQUE KEY,
  `resumo` text DEFAULT NULL,
  `conteudo` text DEFAULT NULL,
  `imagem` text DEFAULT NULL,
  `status` TINYINT(1) NULL DEFAULT '1',
  `categoria_id` int unsigned DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alterado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `departamentos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `departamento` varchar(255) DEFAULT NULL UNIQUE KEY,
  `status` TINYINT(1) NULL DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alterado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `produtos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) DEFAULT NULL,
  `referencia` varchar(50) DEFAULT NULL UNIQUE KEY,
  `codigo_barras` varchar(13) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` text DEFAULT NULL,
  `estoque` int DEFAULT '0',
  `preco_custo` decimal(12,2) DEFAULT '0.00',
  `preco_venda` decimal(12,2) DEFAULT '0.00',
  `status` TINYINT(1) NULL DEFAULT '1',
  `departamento_id` int unsigned DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alterado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `contatos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `assunto` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alterado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `celular`, `status`, `criado_em`, `alterado_em`) VALUES (NULL, 'Administrador', 'admin@admin.com', MD5('admin'), NULL, '1', current_timestamp(), NULL);

CREATE TABLE `anuncios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `status` TINYINT(1) NULL DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alterado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;