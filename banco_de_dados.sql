-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.10-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para kabum-teste
CREATE DATABASE IF NOT EXISTS `kabum-teste` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kabum-teste`;

-- Copiando estrutura para tabela kabum-teste.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela kabum-teste.cliente: 0 rows
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela kabum-teste.cliente_endereco
CREATE TABLE IF NOT EXISTS `cliente_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela kabum-teste.cliente_endereco: 0 rows
/*!40000 ALTER TABLE `cliente_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente_endereco` ENABLE KEYS */;

-- Copiando estrutura para tabela kabum-teste.login
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela kabum-teste.login: 1 rows
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`id`, `nome`, `email`, `senha`) VALUES
	(1, 'David', 'davidakhaddad@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
