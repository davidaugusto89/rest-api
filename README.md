# REST API
REST API para manipular as tabelas do banco de dados (cliente, cliente_endereco e login).

A seguir será detalhado as configurações para executar localmente o banco de dados e a aplicação back-end.

## Requisitos básicos

PHP >= 7

MySQL

Composer

Git

## Guia de Instalação

Para instalar a aplicação, deve ser executados os seguintes comandos no terminal do diretório publico do servidor PHP (www ou public_html).

```sh
git clone https://github.com/davidaugusto89/rest-api rest-api
cd rest-api
```

## Banco de dados - MySQL
O banco de dados deve ser criado localmente, com as seguintes configurações:

    Host = 'localhost'
	Usuário = 'root'
	Senha = ''
	Nome do banco de dados = kabum-teste
	
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

    INSERT INTO `login` (`id`, `nome`, `email`, `senha`) VALUES 
	(1, 'David', 'davidakhaddad@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');


## Back-End - PHP
Back-end desenvolvido sem framework, utilizando somente classes e objeto PDO  de conexão ao banco de dados referente ao PHP >= 7.


## End-points

### Tabela login
**POST** `http://localhost/rest-api/login/`	- verifica o e-mail e senha no banco de dados, se são válidos.


### Tabela cliente
**GET** `http://localhost/rest-api/clientes/` - lista todos os clientes cadastrados.

**GET** `http://localhost/rest-api/clientes/{id}` - busca as informações do cliente com base no {id}.

**POST** `http://localhost/rest-api/clientes/` - cadastra um novo cliente.

**POST** `http://localhost/rest-api/clientes/{id}` - atualiza o cadastro do cliente com base no {id}.

**DELETE** `http://localhost/rest-api/clientes/{id}` - remove o cadastro do cliente com base no {id}.


### Tabela cliente_endereco
**GET** `http://localhost/rest-api/cliente-enderecos/{id_cliente}` - lista todos os endereços de um cliente com base no {id_cliente}.

**POST** `http://localhost/rest-api/cliente-enderecos/` - cadastra um novo endereço do cliente.

**POST** `http://localhost/rest-api/cliente-enderecos/{id}` - atualiza o cadastro do endereço do cliente com base no {id}.

**DELETE** `http://localhost/rest-api/cliente-enderecos/{id}` - remove o cadastro de endereço do cliente com base no {id}.


## End-point [externo]
Para consulta de CEP, está sendo utilizado o end-point do projeto [BrasilAPI](https://github.com/BrasilAPI/BrasilAPI).

**GET**  `https://brasilapi.com.br/api/cep/v1/`**[cep]**