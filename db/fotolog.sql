-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 31/08/2020 às 23:45
-- Versão do servidor: 5.7.25
-- Versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fotolog`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL DEFAULT '',
  `senha` varchar(30) NOT NULL DEFAULT '',
  `nome` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de Administradores';

--
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`id`, `login`, `senha`, `nome`) VALUES
(1, 'admin', '123456', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `amigos`
--

CREATE TABLE `amigos` (
  `id` int(50) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `amigo` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de amigos';

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(50) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `foto` int(50) NOT NULL DEFAULT '0',
  `nome` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `comentario` text NOT NULL,
  `data` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de Comentários';

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int(50) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `titulo` varchar(50) NOT NULL DEFAULT '',
  `cor_lados` varchar(7) NOT NULL DEFAULT '',
  `cor_meio` varchar(7) NOT NULL DEFAULT '',
  `fonte_tit` varchar(100) NOT NULL DEFAULT '',
  `cor_tit` varchar(7) NOT NULL DEFAULT '',
  `cor_comentario` varchar(7) NOT NULL DEFAULT '',
  `cor_links` varchar(7) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tabela de configuração do fotolog';

-- --------------------------------------------------------

--
-- Estrutura para tabela `contador`
--

CREATE TABLE `contador` (
  `id` int(50) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `acessos` int(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de Acessos';

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversas_chat`
--

CREATE TABLE `conversas_chat` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `conversa` longtext NOT NULL,
  `data_entrada` int(11) NOT NULL DEFAULT '0',
  `data_salv` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de conversas de usuários';

-- --------------------------------------------------------

--
-- Estrutura para tabela `fontes`
--

CREATE TABLE `fontes` (
  `id` int(50) NOT NULL,
  `fonte` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de Fontes';

--
-- Despejando dados para a tabela `fontes`
--

INSERT INTO `fontes` (`id`, `fonte`) VALUES
(1, 'Verdana'),
(2, 'Arial'),
(3, 'Times New Roman'),
(4, 'Georgia'),
(5, 'Geneva'),
(6, 'Courier New');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos`
--

CREATE TABLE `fotos` (
  `id` int(50) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '0',
  `foto` varchar(100) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `comentario` text NOT NULL,
  `data` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tabela de fotos';

-- --------------------------------------------------------

--
-- Estrutura para tabela `links`
--

CREATE TABLE `links` (
  `id` int(50) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `nome` varchar(25) NOT NULL DEFAULT '',
  `link` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de Links';

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int(50) NOT NULL,
  `user` varchar(15) NOT NULL DEFAULT '',
  `titulo` varchar(50) NOT NULL DEFAULT '',
  `noticia` text NOT NULL,
  `data` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de Notícias';

-- --------------------------------------------------------

--
-- Estrutura para tabela `online`
--

CREATE TABLE `online` (
  `id` int(50) NOT NULL,
  `timestamp` int(50) NOT NULL DEFAULT '0',
  `nome` varchar(15) NOT NULL DEFAULT '',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `pagina` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabela de usuários on line';

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `nome` varchar(30) NOT NULL DEFAULT '',
  `sobrenome` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(15) NOT NULL DEFAULT '',
  `senha` varchar(30) NOT NULL DEFAULT '',
  `sexo` varchar(9) NOT NULL DEFAULT '',
  `data_nasc` varchar(10) NOT NULL DEFAULT '',
  `pais` varchar(50) NOT NULL DEFAULT '',
  `estado` char(3) NOT NULL DEFAULT '',
  `cep` varchar(9) NOT NULL DEFAULT '',
  `sobre` text NOT NULL,
  `endereco` varchar(100) NOT NULL DEFAULT '',
  `numero` varchar(10) NOT NULL DEFAULT '',
  `complemento` varchar(100) NOT NULL DEFAULT '',
  `bairro` varchar(50) NOT NULL DEFAULT '',
  `cidade` varchar(50) NOT NULL DEFAULT '',
  `telefone` varchar(13) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tabela de usuarios';

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contador`
--
ALTER TABLE `contador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `conversas_chat`
--
ALTER TABLE `conversas_chat`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fontes`
--
ALTER TABLE `fontes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `contador`
--
ALTER TABLE `contador`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `conversas_chat`
--
ALTER TABLE `conversas_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `fontes`
--
ALTER TABLE `fontes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `links`
--
ALTER TABLE `links`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `online`
--
ALTER TABLE `online`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
