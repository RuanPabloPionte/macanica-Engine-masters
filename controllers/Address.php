<?php
session_start();

extract($_POST);
require( '../classes/Address.php');
require( '../classes/Person.php');
$address = new Address();
$person = new Person();


if(isset($_POST['btnEditAddress'])){

    $cd_address = $_POST['cd_address'];
    $cep = $_POST['cep'];
    $street = $_POST['street'];
    $house_number = $_POST['house_number'];
    $neighborhood = $_POST['neighborhood'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    echo 'edit address';
    $address->updateAddress($cd_address,$cep, $street, $house_number, $neighborhood, $city, $region);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");
    
}else if(isset($_POST['btnCadastrar'])){
    $email = $_POST['email'];
    $address->createAddress($cep,$street,$house_number,$neighborhood,$city,$region);
    $lastAddress = $address->getLastCd_address();
    $person->insertAddressByEmail($email,$lastAddress);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");
}

?>



<!-- 
// $btnCadastrar = $_POST['btnCadastrar'];

// $cd_address = $_POST['cd_address'];
// $cep = $_POST['cep'];
// $street = $_POST['street'];
// $house_number = $_POST['house_number'];
// $neighborhood = $_POST['neighborhood'];
// $city = $_POST['city'];
// $region = $_POST['region'];

// echo $cd_address;
// echo '<br>';
// echo $cep;
// echo '<br>';
// echo $street;
// echo '<br>';
// echo $house_number;
// echo '<br>';
// echo $neighborhood;
// echo '<br>';
// echo $city;
// echo '<br>';
// echo $region;
// echo '<br>';


// echo $address->getLastCd_address(); -->