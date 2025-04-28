-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/04/2025 às 23:20
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
-- Banco de dados: `banco_advocacia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `codigo_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `telefone_cliente` varchar(100) NOT NULL,
  `endereco_cliente` varchar(100) NOT NULL,
  `email_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`codigo_cliente`, `nome_cliente`, `telefone_cliente`, `endereco_cliente`, `email_cliente`) VALUES
(1, 'regis', '999999999', 'rua dos imigrantes, 203', 'regis.f.alves@hotmail.com'),
(2, 'eliza', '99999999', 'rua dos imigrantes, 203', 'eliza_regina10@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `codigo_pagamento` int(11) NOT NULL,
  `status_pagamento` varchar(100) NOT NULL,
  `data_vencimento_pagamento` date NOT NULL,
  `servico_realizado_pagamento` varchar(100) NOT NULL,
  `codigo_cliente_pagamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamento`
--

INSERT INTO `pagamento` (`codigo_pagamento`, `status_pagamento`, `data_vencimento_pagamento`, `servico_realizado_pagamento`, `codigo_cliente_pagamento`) VALUES
(2, 'pendente', '2025-04-27', 'Verificação do andamento do processo judicial', 1),
(3, 'pendente', '2025-04-28', 'Intimação', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `codigo_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `login_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(100) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `perfil_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`codigo_usuario`, `nome_usuario`, `login_usuario`, `senha_usuario`, `email_usuario`, `perfil_usuario`) VALUES
(1, 'idail neto', 'idail', 'e10adc3949ba59abbe56e057f20f883e', 'neto_br_8@hotmail.com', 'administrador'),
(2, 'idail', 'idail', 'e10adc3949ba59abbe56e057f20f883e', 'idaillopes@gmail.com', 'administrador'),
(3, 'regis', 'regis', 'e10adc3949ba59abbe56e057f20f883e', 'regis@hotmail.com', 'administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo_cliente`);

--
-- Índices de tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`codigo_pagamento`),
  ADD KEY `codigo_cliente_pagamento` (`codigo_cliente_pagamento`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `codigo_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `chave_estrangeira_pagamento_cliente` FOREIGN KEY (`codigo_cliente_pagamento`) REFERENCES `cliente` (`codigo_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
