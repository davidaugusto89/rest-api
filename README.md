# REST API
REST API para manipular as tabelas do banco de dados (cliente, cliente_endereco e login).

A seguir será detalhado as configurações para executar localmente o banco de dados e a aplicação back-end.

## Banco de dados - MySQL
O banco de dados deve ser criado localmente, com as seguintes configurações:

    Host: 'localhost'
	Usuário: 'root'
	Senha: '' (não informar)
	Nome do banco de dados: kabum-teste
	
Após criar o banco de dados, executar os comandos SQL do arquivo **banco_de_dados.sql**, ou copiar os comandos abaixo:
	
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

    CREATE TABLE IF NOT EXISTS `login` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `nome` varchar(50) DEFAULT NULL,
      `email` varchar(100) DEFAULT NULL,
      `senha` varchar(32) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    INSERT INTO `login` (`id`, `nome`, `email`, `senha`) VALUES (1, 'David', 'davidakhaddad@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');