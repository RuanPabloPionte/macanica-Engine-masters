<?php
require_once('C:\xampp\htdocs\projects\mecanica\config\config.php');

class Person {
    private $conn;

    public function __construct() {
        $db = new db;
        $this->conn = $db->connect();
    }

    public function createPerson($name, $email, $password, $cd_address=null) {
        $sql = "INSERT INTO person (name, email, password, cd_address) VALUES (:name, :email, :password, :cd_address)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':cd_address', $cd_address);

        return $stmt->execute();
    }

    public function getPersonById($cd_person) {
        $sql = "SELECT * FROM person WHERE cd_person = :cd_person";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_person', $cd_person);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePerson($cd_person, $name, $email, $password, $cd_address) {
        $sql = "UPDATE person SET name = :name, email = :email, password = :password, cd_address = :cd_address WHERE cd_person = :cd_person";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_person', $cd_person);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':cd_address', $cd_address);

        return $stmt->execute();
    }
    public function insertAddressByEmail($email, $cd_address) {
        $sql = "UPDATE person set cd_address = :cd_address WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cd_address', $cd_address);

        return $stmt->execute();
    }

        public function deletePersonById($cd_person) {
        $sql = "DELETE FROM person WHERE cd_person = :cd_person";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cd_person', $cd_person);

        return $stmt->execute();
    }
    
    // public function getAddressByEmail($email){
    //     $sql = "SELECT a.cep, a.street,a.house_number, a.neighborhood, a.city, a.region 
    //     FROM person p
    //     JOIN address a ON p.cd_address = a.cd_address
    //     WHERE p.email = ':email'
    //     ";

    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':email',$email);

    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // verifica o login do usuario
    public function testLogin(){
        if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']))
        {
            // Acessa
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // print_r('email: ' . $email);
            // print_r('<br>');
            // print_r('password: ' . $password);
    
            $sql = "SELECT * FROM person WHERE email = '$email' and password = '$password'";
    
            $result = $this->conn->query($sql);
    
            // print_r($sql);
           
    
    
            if($result->rowCount() < 1)
            {
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                header('Location: http://localhost/PROJECTS/mecanica/pages/login.php');
            }
            else
            {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $_SESSION['cd_person'] = $row['cd_person'];
                // echo 'success';
                header('Location: http://localhost/PROJECTS/mecanica/pages/agendar.php');
            }
        }
        else
        {
            // Não acessa
            header('Location: login.php');
            // echo 'error';
        }
    }

    // logut
    public function logut(){
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['cd_person']);
        header('Location: http://localhost/PROJECTS/mecanica/pages/login.php');
    }
}



// $person = new Person();




// $person->createPerson('ruan','ruan@example.com','ruan',1);

// $person->insertAddressByEmail('ruan@gmail.com',1);

// $person->deletePersonById(4);
// try {
//     foreach ($person->getPersonById(1) as $row) {
//         echo $row['name'];
//         echo $row['email'];
//         echo $row['password'];
//         echo $row['cd_address'];
//     }
// } catch (PDOException $e) {
//     echo 'Error: ';
// }


?>
