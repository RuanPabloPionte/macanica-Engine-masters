<?php

use PhpParser\Node\Stmt;

require_once('C:\xampp\htdocs\projects\mecanica\config\config.php');

class Address {
    private $conn;

    public function __construct() {
        $db = new db;
        $this->conn = $db->connect();
    }

    public function createAddress($cep,$street,$house_number,$neighborhood,$city,$region) {
        $sql = "INSERT INTO address (cep,street,house_number,neighborhood,city,region) VALUES (:cep,:street,:house_number,:neighborhood,:city,:region)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':house_number', $house_number);
        $stmt->bindParam(':neighborhood', $neighborhood);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':region', $region);
        return $stmt->execute();
    }

    public function getAddressByCd($cd_address) {
        $sql = "SELECT * FROM address where cd_address= :cd_address";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_address', $cd_address);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAddressByEmail($email){
        $sql = "SELECT a.cd_address,a.cep,a.street,a.house_number,a.neighborhood,a.city,a.region FROM address a, person p
        WHERE p.email = :email
        AND  a.cd_address = p.cd_address
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAddress(){
        $sql = "SELECT a.cd_address,a.cep,a.street,a.house_number,a.neighborhood,a.city,a.region FROM address a
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLastCd_address(){
        $sql = "SELECT cd_address FROM address ORDER BY cd_address DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();  
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $cd_address = $result['cd_address'];
    
        return $cd_address;
    }
    

    public function updateAddress($cd_address,$cep, $street, $house_number, $neighborhood, $city, $region) {
        $sql = "UPDATE address SET cep = :cep, street = :street, house_number = :house_number, neighborhood = :neighborhood, city = :city, region = :region  WHERE cd_address = :cd_address";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_address', $cd_address);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':house_number', $house_number);
        $stmt->bindParam(':neighborhood', $neighborhood);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':region', $region);

        return $stmt->execute();
    }

    public function deleteAddressId($cd_address) {
        $sql = "DELETE FROM address WHERE cd_address = :cd_address";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_address', $cd_address);

        return $stmt->execute();
    }

    
   
}


$address = new Address();

 
// echo $address->getLastCd_address();


// $address->createaddress('29705493','Avenida Dulcino Baptista Ximenes',265,'Ayrton Senna','Colatina','ES'); //done

// // $address->updateAddress(3,'29701712','rua_gremio',352,'azenha','porto_alegre','rs');

// // $address->deleteAddressId(3);
// try {
//     foreach ($address->getLastCd_address() as $row) {
//         echo $row['cd_address'];
//         // echo $row['cep'];
//         // echo $row['street'];
//         // echo $row['house_number'];
//         // echo $row['neighborhood'];
//         // echo $row['city'];
//         // echo $row['region'];
//         // echo '<br>';
//     }
// } catch (PDOException $e) {
//     echo 'Error: ';
// }








            



            