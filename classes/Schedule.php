<?php
require_once('C:\xampp\htdocs\projects\mecanica\config\config.php');

class Schedule {
    private $conn;

    public function __construct() {
        $db = new db;
        $this->conn = $db->connect();
    }

    public function createSchedule($cd_person,$cd_servece, $V_plate) {
        $sql = "INSERT INTO schedule (cd_person, cd_servece, V_plate) VALUES (:cd_person, :cd_servece, :V_plate)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_person', $cd_person);
        $stmt->bindParam(':cd_servece', $cd_servece);
        $stmt->bindParam(':V_plate', $V_plate);
        
        return $stmt->execute();
    }

    public function getScheduleByEmail($email) {
        $sql = "SELECT s.cd_schedule,se.cd_servece, se.nm_servece,p.cd_person, p.name,v.V_plate, v.vehicleName
        FROM  schedule s
        JOIN servece se ON s.cd_servece = se.cd_servece
        JOIN person p ON s.cd_person = p.cd_person
        JOIN vehicle v ON s.V_plate = v.V_plate
        WHERE p.email =	:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateSchedule($cd_schedule, $cd_person,$cd_servece, $V_plate) {
        $sql = "UPDATE schedule SET cd_person = :cd_person, cd_servece = :cd_servece, V_plate = :V_plate WHERE cd_schedule = :cd_schedule";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_schedule', $cd_schedule);
        $stmt->bindParam(':cd_person', $cd_person);
        $stmt->bindParam(':cd_servece', $cd_servece);
        $stmt->bindParam(':V_plate', $V_plate);

        return $stmt->execute();
    }
        public function deleteScheduleId($cd_schedule) {
        $sql = "DELETE FROM schedule WHERE cd_schedule = :cd_schedule";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_schedule', $cd_schedule);

        return $stmt->execute();
    }
    
   
}



// $schedule = new Schedule();




// $schedule->createSchedule(1,4,'qfz1j33');

// $schedule->updateSchedule(1,1,2,'qfz1j33');

// $schedule->deleteScheduleId(4);
// try {
//     foreach ($schedule->getScheduleByEmail("ruan@gmail.com") as $row) {
//         echo $row['nm_servece'];
//         echo '<br>';
//         echo $row['name'];
//         echo '<br>';
//         echo $row['vehicleName'];
//         echo '<br>';
//     }
// } catch (PDOException $e) {
//     echo 'Error: ';
// }