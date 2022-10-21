-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Set-2022 às 01:20
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ferramentas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabpro`
--

CREATE TABLE `tabpro` (
  `TABPRO_ID` int(11) NOT NULL,
  `TABPRO_Descricao` varchar(30) NOT NULL,
  `TABPRO_CodWHB` varchar(30) DEFAULT NULL,
  `TABPRO_Fornecedor` varchar(45) NOT NULL,
  `TABPRO_VelCorte` decimal(6,2) DEFAULT NULL,
  `TABPRO_Avanco` decimal(6,2) DEFAULT NULL,
  `TABPRO_CompUsi` decimal(6,2) DEFAULT NULL,
  `TABPRO_Nova_CustPast` decimal(6,2) DEFAULT NULL,
  `TABPRO_Nova_QtdAresta` int(11) DEFAULT NULL,
  `TABPRO_Nova_QtdPast` int(11) DEFAULT NULL,
  `TABPRO_Nova_VidaUtil` decimal(6,2) DEFAULT NULL,
  `TABPRO_Alisa_CustPast` decimal(6,2) DEFAULT NULL,
  `TABPRO_Alisa_QtdAresta` int(11) DEFAULT NULL,
  `TABPRO_Alisa_QtdPast` int(11) DEFAULT NULL,
  `TABPRO_Alisa_VidaUtil` varchar(45) DEFAULT NULL,
  `TABPRO_PrevProdAnual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tabpro`
--
ALTER TABLE `tabpro`
  ADD PRIMARY KEY (`TABPRO_ID`,`TABPRO_Descricao`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tabpro`
--
ALTER TABLE `tabpro`
  MODIFY `TABPRO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
