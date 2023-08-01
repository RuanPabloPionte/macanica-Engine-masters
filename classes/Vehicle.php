<?php
require_once('C:\xampp\htdocs\projects\mecanica\config\config.php');

class Vehicle {
    private $conn;

    public function __construct() {
        $db = new db;
        $this->conn = $db->connect();
    }

    public function createVehicle($V_plate, $vehicleName,$brand, $vehicleYear ,$vehiclePower, $cd_person) {
        $sql = "INSERT INTO vehicle (V_plate ,vehicleName,brand ,vehicleYear, vehiclePower, cd_person) VALUES (:V_plate , :vehicleName, :brand,:vehicleYear, :vehiclePower, :cd_person)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':V_plate', $V_plate);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':vehicleName', $vehicleName);
        $stmt->bindParam(':vehicleYear', $vehicleYear);
        $stmt->bindParam(':vehiclePower', $vehiclePower);
        $stmt->bindParam(':cd_person', $cd_person);

        return $stmt->execute();
    }

    public function getVehicleByEmail($email) {
        $sql = "SELECT * FROM vehicle v, person p
        WHERE v.cd_person = p.cd_person
        AND p.email = :email";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateVehicle($V_plate, $vehicleName,$brand, $vehicleYear ,$vehiclePower, $cd_person) {
        $sql = "UPDATE vehicle SET V_plate = :V_plate, brand = :brand, vehicleName = :vehicleName, vehicleName = :vehicleName, vehicleYear = :vehicleYear, vehiclePower = :vehiclePower  WHERE V_plate = :V_plate";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':V_plate', $V_plate);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':vehicleName', $vehicleName);
        $stmt->bindParam(':vehicleYear', $vehicleYear);
        $stmt->bindParam(':vehiclePower', $vehiclePower);
        $stmt->bindParam(':cd_person', $cd_person);


        return $stmt->execute();
    }
    

    public function deleteVehicleV_plate($V_plate) {
        $sql = "DELETE FROM vehicle WHERE V_plate = :V_plate";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':V_plate', $V_plate);

        return $stmt->execute();
    }
    
   
}


// $vehicle = new Vehicle();




// $vehicle->createVehicle('qfz1j33','CG 160 TITAN', 'Honda','2019','162cc',1); //done

// $vehicle->updateVehicle('qfz1j33','CG 160 TITAN', 'Honda','2019','162cc',1);

// $vehicle->deleteVehicleV_plate('qfz1j33');
// try {
//     foreach ($vehicle->getVehicleByEmail('ruan@gmail.com') as $row) {
//         echo $row['V_plate'];
//         echo $row['vehicleName'];
        
//     }
// } catch (PDOException $e) {
//     echo 'Error: ';
// }