<?php


class db {
    private $host = 'localhost';
    private $username ='root';
    private $password = '';
    private $dbname ='mecanica';

    public function connect() {
        try {
            $conn_str = "mysql:host=$this->host;dbname=$this->dbname";
            $conn = new PDO($conn_str, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            return $conn;
        } catch (PDOException $e) {
            throw new Exception("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
}
