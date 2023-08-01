<?php
session_start();
extract($_POST);
require('../classes/Person.php');
$person  = new Person();

if(isset($_POST['submitPerson'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $person->createPerson($name, $email, $password);
    $_SESSION['email'] = $email;
    header('Location: http://localhost/PROJECTS/mecanica/pages/login.php');
    }

// echo $_POST['cd_address'];
?>