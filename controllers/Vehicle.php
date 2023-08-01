<?php
session_start();
require( '../classes/Vehicle.php');
$vehicle = new Vehicle();
extract($_POST);


// $btnDeleteVehicle = $_POST['btnDeleteVehicle'];
// $btnEditVehicle = $_POST['btnEditVehicle'];
// $btnNewVehicle = $_POST['btnNewVehicle'];
$V_plate = $_POST['V_plate'];
$vehicleName = $_POST['vehicleName'];
$brand = $_POST['brand'];
$vehicleYear = $_POST['vehicleYear'];
$vehiclePower = $_POST['vehiclePower'];
$cd_person = $_POST['cd_person'];


// echo '<br>';
// echo $vehicleName;
// echo '<br>';
// echo $brand;
// echo '<br>';
// echo $vehicleYear;
// echo '<br>';
// echo $vehiclePower;
// echo '<br>';
// echo $cd_person;
// echo '<br>';
// echo $btnNewVehicle;


if (isset($_POST['btnDeleteVehicle'])){
    $V_plate = $_POST['V_plate'];
    // echo $V_plate;
    $vehicle->deleteVehicleV_plate($V_plate);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");
}else if(isset($_POST['btnEditVehicle'])){
    $vehicle->updateVehicle($V_plate, $vehicleName,$brand, $vehicleYear ,$vehiclePower, $cd_person);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");
}if(isset($_POST['btnNewVehicle'])){
    echo 'new vehicle';
    $vehicle->createVehicle($V_plate, $vehicleName,$brand, $vehicleYear ,$vehiclePower, $cd_person);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");
}

?>
