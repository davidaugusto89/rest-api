<?php
    class Cliente{
        private $conn;

        public $id;
        public $nome;
        public $email;
        public $data_nascimento;
        public $cpf;
        public $rg;
        public $telefone;
        public $total_count;

        public function __construct($db){
            $this->conn = $db;
        }

        public function listClientes(){
            if($this->id <= 0 || $this->id == '' || $this->id == null){
              $sqlQuery = "SELECT *
                             FROM cliente
                         ORDER BY id";
              $stmt = $this->conn->prepare($sqlQuery);
              $stmt->execute();
              $this->total_count = $stmt->rowCount();
              $dataRow = $stmt->fetchAll();
            }else{
              $sqlQuery = "SELECT *
                             FROM cliente
                            WHERE id = :id
                         ORDER BY id";
              $stmt = $this->conn->prepare($sqlQuery);
              $stmt->bindParam(':id', $this->id);
              $stmt->execute();
              $this->total_count = $stmt->rowCount();
              $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $dataRow;
        }

        public function cadCliente(){
          $sqlQuery = "INSERT INTO cliente (nome, email, data_nascimento, cpf, rg, telefone)
                      VALUES (:nome, :email, :data_nascimento, :cpf, :rg, :telefone)";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':nome', $this->nome);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':data_nascimento', $this->data_nascimento);
          $stmt->bindParam(':cpf', $this->cpf);
          $stmt->bindParam(':rg', $this->rg);
          $stmt->bindParam(':telefone', $this->telefone);
          $stmt->execute();
          $this->id =  $this->conn->lastInsertId();
        }

        public function updateCliente(){
          $sqlQuery = "UPDATE cliente SET nome = :nome,
                                          email = :email,
                                          data_nascimento = :data_nascimento,
                                          cpf = :cpf,
                                          rg = :rg,
                                          telefone = :telefone
                                    WHERE id = :id";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':nome', $this->nome);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':data_nascimento', $this->data_nascimento);
          $stmt->bindParam(':cpf', $this->cpf);
          $stmt->bindParam(':rg', $this->rg);
          $stmt->bindParam(':telefone', $this->telefone);
          $stmt->bindParam(':id', $this->id);
          $stmt->execute();
        }

        public function deleteCliente(){
          $sqlQuery = "DELETE FROM cliente WHERE id = :id";
          $stmt = $this->conn->prepare($sqlQuery);
          $stmt->bindParam(':id', $this->id);
          $stmt->execute();
        }
    }
?>
