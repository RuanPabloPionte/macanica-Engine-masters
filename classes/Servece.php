<?php
require_once('C:\xampp\htdocs\projects\mecanica\config\config.php');

class Servece {
    private $conn;

    public function __construct() {
        $db = new db;
        $this->conn = $db->connect();
    }

    public function createServece($nm_servece) {
        $sql = "INSERT INTO servece (nm_servece) VALUES (:nm_servece)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nm_servece', $nm_servece);

        return $stmt->execute();
    }

    public function getServece() {
        $sql = "SELECT * FROM servece";
        $stmt = $this->conn->prepare($sql);
        // $stmt->bindParam(':cd_servece', $cd_servece);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServeceById($cd_servece) {
        $sql = "SELECT * FROM servece WHERE cd_servece = :cd_servece";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_servece', $cd_servece);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateServece($cd_servece, $nm_servece) {
        $sql = "UPDATE servece SET nm_servece = :nm_servece WHERE cd_servece = :cd_servece";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_servece', $cd_servece);
        $stmt->bindParam(':nm_servece', $nm_servece);

        return $stmt->execute();
    }

        public function deleteServeceId($cd_servece) {
        $sql = "DELETE FROM servece WHERE cd_servece = :cd_servece";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_servece', $cd_servece);

        return $stmt->execute();
    }
    
   
}



// $servece = new Servece();




// // $servece->createServece('vidrificação');

// // // $servece->updateServece(7,'vidrificação');

// // $servece->deleteServeceId(9);
// try {
//     foreach ($servece->getServece() as $row) {
//         echo $row['nm_servece'];
//         echo '<br>';
//     }
// } catch (PDOException $e) {
//     echo 'Error: ';
// }