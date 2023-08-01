<?php

use phpDocumentor\Reflection\Location;
session_start();

require( '../classes/Servece.php');
require( '../classes/Vehicle.php');
require( '../classes/Address.php');
require( '../classes/Schedule.php');

$servece = new Servece();
$vehicle = new Vehicle();
$address = new Address();
$schedule = new Schedule();

extract($_POST);
$cd_schedule = $_POST['cd_schedule'];
$cd_person = $_POST['cd_person'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- link css boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- boostrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <!-- script do boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous">
  </script>

  <script src="../js/agendar.js" defer></script>

  <link rel="stylesheet" href="../css/editSchecule.css">
  <title>BEM VINDO A ENGINE MASTERS</title>
</head>
<body>
<div class="container main-content mt-3 pt-5">
    <h1 class="d-flex justify-content-center">BEM VINDO!</h1>
    <H2 class="d-flex justify-content-center">EDIT O SEU HORARIO CONOSCO</H2>
    <form class="cantainer-fluid pt-4" method="POST" action="../controllers/Schedule.php">
      <input type="text" name="cd_person" id=""  value="<?php echo $cd_person?>" hidden>
      <input type="text" name="cd_schedule" id=""  value="<?php echo $cd_schedule?>" hidden>
      <div class="input-group mb-3">
        <label for="servece" class="input-group-text btn btn-dark" type="button" id="button-addon1" >Serviço</label>
        <?php
        // Consulta SQL para selecionar os serviços
        
        $result = $servece->getServece();
        ?>
            <select class="form-control" name="servece" id='servece'>
              <?php foreach ($result as $value) { ?>
                <option value="<?php echo $value["cd_servece"]; ?>"><?php echo $value["nm_servece"]; ?></option>
              <?php } ?>
            </select>
      </div>
      <div class="input-group mb-3">
        <label for="dt-atendimento" class="label btn btn-dark" type="button" id="button-addon1">Data do atendimento</label>
        <input type="date" class="form-control" placeholder="" name='dt_atendimento' id="dt-atendimento" required>
      </div>
      <div class="input-group mb-3">
        <label for="V_plate" class="label btn btn-dark" type="button" id="button-addon1">Veiculo</label>
        <?php
        // Consulta SQL para  os serviços
        $result = $vehicle->getVehicleByEmail($email);
        ?>
            <select class="form-control" name="V_plate" id="V_plate">
              <?php foreach ($result as $value) { ?>
                <option value="<?php echo $value["V_plate"]; ?>"><?php echo $value["vehicleName"]; ?></option>
              <?php } ?>
            </select>
      </div>
        <input class='btn btn-dark w-100' type="submit" name="btnEditSchedule" value="EDIT">
    </form> 
  </div>
  </body>
</html>