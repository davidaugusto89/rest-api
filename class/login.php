<?php
    class Login{
        private $conn;

        public $email;
        public $senha;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getLogin(){
            $sqlQuery = "SELECT id
                           FROM login
                          WHERE email = :email
                            AND senha = :senha
                          LIMIT 1";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam('email', $this->email);
            $stmt->bindParam('senha', $this->senha);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }
?>
