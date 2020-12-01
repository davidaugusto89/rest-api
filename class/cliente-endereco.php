<?php
    class ClienteEndereco{
        private $conn;

        public $id;
        public $id_cliente;
        public $cep;
        public $logradouro;
        public $numero;
        public $complemento;
        public $bairro;
        public $cidade;
        public $estado;
        public $total_count;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listEnderecos(){
          $sqlQuery = "SELECT *
                         FROM cliente_endereco
                        WHERE id_cliente = :id_cliente
                     ORDER BY id";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':id_cliente', $this->id_cliente);
          $stmt->execute();
          $this->total_count = $stmt->rowCount();
          $dataRow = $stmt->fetchAll();
          return $dataRow;
        }

        public function cadEndereco(){
          $sqlQuery = "INSERT INTO cliente_endereco (id_cliente, cep, logradouro, numero, complemento, bairro, cidade, estado)
                      VALUES (:id_cliente, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado)";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':id_cliente', $this->id_cliente);
          $stmt->bindParam(':cep', $this->cep);
          $stmt->bindParam(':logradouro', $this->logradouro);
          $stmt->bindParam(':numero', $this->numero);
          $stmt->bindParam(':complemento', $this->complemento);
          $stmt->bindParam(':bairro', $this->bairro);
          $stmt->bindParam(':cidade', $this->cidade);
          $stmt->bindParam(':estado', $this->estado);
          $stmt->execute();
          $this->id =  $this->conn->lastInsertId();
        }

        public function updateEndereco(){
          $sqlQuery = "UPDATE cliente_endereco  SET id_cliente = :id_cliente,
                                                    cep = :cep,
                                                    logradouro = :logradouro,
                                                    numero = :numero,
                                                    complemento = :complemento,
                                                    bairro = :bairro,
                                                    cidade = :cidade,
                                                    estado = :estado
                                              WHERE id = :id";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':id_cliente', $this->id_cliente);
          $stmt->bindParam(':cep', $this->cep);
          $stmt->bindParam(':logradouro', $this->logradouro);
          $stmt->bindParam(':numero', $this->numero);
          $stmt->bindParam(':complemento', $this->complemento);
          $stmt->bindParam(':bairro', $this->bairro);
          $stmt->bindParam(':cidade', $this->cidade);
          $stmt->bindParam(':estado', $this->estado);
          $stmt->bindParam(':id', $this->id);
          $stmt->execute();
        }

        public function deleteEndereco(){
          $sqlQuery = "DELETE FROM cliente_endereco WHERE id_cliente = :id_cliente";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':id_cliente', $this->id_cliente);
          $stmt->execute();
        }

        public function deleteEnderecoID(){
          $sqlQuery = "DELETE FROM cliente_endereco WHERE id = :id";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':id', $this->id);
          $stmt->execute();
        }
    }
?>
