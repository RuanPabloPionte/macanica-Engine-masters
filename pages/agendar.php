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

  <link rel="stylesheet" href="../css/agendar.css">
  <title>BEM VINDO A ENGINE MASTERS</title>
</head>

<body>
<?php
session_start();
require( '../classes/Servece.php');
require( '../classes/Vehicle.php');
require( '../classes/Address.php');
require( '../classes/Schedule.php');
$servece = new Servece();
$vehicle = new Vehicle();
$address = new Address();
$schedule = new Schedule();

// verifica se tem sessão
if((!isset($_SESSION['email'])==true) and !isset($_SESSION['password'])==true){
  unset($_SESSION['email']);
  unset($_SESSION['password']);
  unset($_SESSION['cd_person']);
  header('Location: http://localhost/PROJECTS/mecanica/pages/login.php');
};
$email = $_SESSION['email'];
$cd_person = $_SESSION['cd_person'];

?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <img class="logo" src="../img/logo.png" alt="logo">
    <a class="navbar-brand" href="./principal.php">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
    </span>
    </button>
  </div>
  <div class="collapse navbar-collapse p-2" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class=" nav-item  btn btn-dark nav-link">
        <span data-user data-openPerfil class="email text-md-center"><?php echo $email ?></span>
      </li>
      <li class="nav-item  mx-1">
        <a class="nav-link" href="../pages/login.php">
          <i class="bi bi-box-arrow-in-right"></i>
        </a>
      </li>
      </li>
      <li class="nav-item">
        <a  class="nav-link" href="../config/logout.php">
          <i class="bi bi-box-arrow-in-left"></i>
        </a>
      </li>
      </ul>
  </div>
</nav>

<!-- main content -->
<!-- schedule Form -->
<div class="container pt-4">
  <div class="container">
  <div class="row row-cols-2 row-cols-lg-3 d-flex justify-content-center">
    <div class="container main-content pt-5">
    <h1 class="d-flex justify-content-center">BEM VINDO!</h1>
    <H2 class="d-flex justify-content-center">AGENDE O SEU HORARIO CONOSCO</H2>
    <form class="cantainer-fluid pt-4" method="POST" action="../controllers/Schedule.php" id="newScheduleForm">
      <input type="text" name="cd_person" id=""  value="<?php echo $cd_person?>" hidden>
      <div class="input-group mb-3">
        <label for="servece" class="input-group-text btn btn-dark" type="button" id="button-addon1" >Serviço</label>
        <?php
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
        <input type="date" class="form-control" placeholder="" name='dt_atendimento' id="dt-atendimento">
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
        <input class='btn btn-dark w-100' type="submit" name="agendar" value="Agendar">
    </form> 
  </div>

<!-- end of schedule form -->


  <!-- perfil pop up -->
  <dialog data-modal-perfil class="modal-perfil container">
    <input type="text" autofocus class="inputFake">
    <span data-btnClosePerfil class="closePerfil">
      X
    </span>        
      <i class="bi bi-file-person mx-1"></i><span data-user><?php echo $email ?>
    </span>
    <hr>

    <!-- address div -->
    <h2 class="address-tille">Endereço: </h2>
    <div class="muilt-container">
    <?php
    // Consulta SQL para selecionar os dados do veículo
    $result = $address->getAddressByEmail($email);
    ?>
    <?php foreach ($result as $row): ?>
      <form action="../controllers/Address.php" method="post" id="AddressForm">
      <div class="row" id="showAdress">

        <input class="form-control" type="text" value="<?php echo $row['cd_address']; ?>" name="cd_address" hidden>
        <div class="col-md-6">

          <label for="region">UF: </label>
          <input class="form-control" type="text" value="<?php echo $row['region']; ?>" name="region" id='region'>

          <label for="cep">cep: </label>
          <input class="form-control" type="text" value="<?php echo $row['cep']; ?>" name="cep" id="cep">

          <label for="cidade">Cidade: </label>
          <input class="form-control" type="text" value="<?php echo $row['city']; ?>" name="city" id="cidade">

        </div>
        <div class="col-md-5">

          <label for="rua">Rua: </label>
          <input class="form-control" type="text" value="<?php echo $row['street']; ?>" name="street" id="rua">
          <label for="numero">N°: </label>
          <input class="form-control" type="text" value="<?php echo $row['house_number']; ?>" name="house_number" id="numero">
          <label for="bairro">Bairro: </label>
          <input class="form-control" type="text" value="<?php echo $row['neighborhood']; ?>" name="neighborhood" id="bairro">

        </div>
        <div class="col-sm-1">
          <!-- edit icon -->
          <button class="btn btn-dark" name='btnEditAddress'class="btn btn-dark" type='submit' value="btnEditAddress">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
              </svg>
            </button>
        </div>
      </div>
      </form>
    <?php endforeach; ?>
    <form action="../pages/cep.php">
      <button class="btn btn-dark mt-2" name='btnAddAddress'class="btn btn-dark" type='submit' value="btnAddAddress">
      CADASTRAR 
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
      </button>
    </form>
    </div>
    <hr>


    <!-- end of address -->

<!-- vehicle div -->
    <h2 class="veiculos-title">Veiculos:</h2>
    <div class="muilt-container" data-vehicleContainer>
    <?php
    // Consulta SQL para selecionar os dados do veículo
    $result = $vehicle->getVehicleByEmail($email);
    ?>

    <?php foreach ($result as $row): ?>

      <form action="../controllers/Vehicle.php" method="post" id="formVehicle">

        <input type="text" value="<?php echo $row['V_plate']?>" name='V_plate' class="inputHidden" hidden>
        <input type="text" value="<?php echo $cd_person?>" name='cd_person' class="inputHidden" hidden>
      <div class="row">
        <div class="col-md-6 " >
            <label for="vehicleName" class="">Nome:</label>
            <input class="form-control" type="text" value="<?php echo $row['vehicleName']; ?>" name="vehicleName" id="vehicleName">

            <label for="brand" class="">Marca:</label>
            <input class="form-control" type="text" value="<?php echo $row['brand']; ?>" name="brand" id="brand">

        </div>
        <div class="col-md-5">
            <label for="vehiclePower" class="">Potencia:</label>
            <input class="form-control" type="text" value="<?php echo $row['vehiclePower']; ?>" name="vehiclePower" id="vehiclePower">

            <label for="vehicleYear" class="">Ano:</label>
            <input class="form-control" type="text" value="<?php echo $row['vehicleYear']; ?>" name="vehicleYear" id="vehicleYear">

        </div>
        <div class="col-md-1" >
          <!-- trash icon -->
          <button  name='btnDeleteVehicle'class="btn btn-dark mb-2" type='submit' value="btnDeleteVehicle">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
            </svg>
          </button>

          <!-- edit icon -->
          
            <button class="btn btn-dark" name="btnEditVehicle" class="btn btn-dark" type='submit' value="btnEditVehicle">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
              </svg>
            </button>

          </div>

      </div>
        
    </form>
        <hr>
    <?php endforeach; ?>
    <button class="btn btn-dark" data-showNewVehicle>
    CADASTRAR
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
    </button>

    <!-- form para cadastrar outro veiculo (acordion) -->
    <form action="../controllers/Vehicle.php" method="POST" class="form-group hide" id="newVehicle" data-newVehicle >
      <div class="row">
        <div class="col-md-6">
          <label for="V_plate-modal" class="form-label">Plate:</label>
          <input type="text" name="V_plate" class="form-control" id="V_plate-modal" required>

          <label for="brand-modal" class="form-label">Marca:</label>
          <input type="text" name="brand" class="form-control shadow-none" id="brand-modal" required>
        </div>
        <div class="col-md-6">
          <label for="vehiclePower-modal" class="form-label">Potencia:</label>
          <input type="text" name="vehiclePower" class="form-control" id="vehiclePower-modal" required>

          <label for="vehicleYear-modal" class="form-label">Ano:</label>
          <input type="text" name="vehicleYear" class="form-control" id="vehicleYear-modal" required>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12">
            <label for="vehicleName-modal" class="form-label">Nome:</label>
            <input type="text" name="vehicleName" class="form-control shadow-none" id="vehicleName-modal" required>
          </div>
        </div>
        <input type="text" name="cd_person" value="<?php echo $cd_person ?>" hidden class="inputHidden ">
        <button type="submit" class="btn btn-primary mt-2" name='btnNewVehicle'>Salvar</button>
      </div>
    
      
    </form>
    <hr>
    <h2 class="atendimentos-title">Atendimentos: </h2>
    <div class="muilt-container" id="showSchedule">
    <?php
    $result = $schedule->getScheduleByEmail($email);
    ?>
    <?php foreach ($result as $row): ?>
      <form action="../controllers/Schedule.php" method="post">

        <input type="text" value="<?php echo $row['cd_schedule']?>" name='cd_schedule' class="inputHidden" hidden>
        <input type="text" value="<?php echo $email?>" name='email' class="inputHidden" hidden>

        <div class="row">
        <div class="col-sm-11">
          <span>Serviço: </span>
          <input class="form-control" type="text" value="<?php echo $row['nm_servece']; ?>" name="servico">

          <span>Dono: </span>
          <input class="form-control" type="text" value="<?php echo $row['name']; ?>" name="dono">

          <span>Veiculo: </span>
          <input class="form-control" type="text" value="<?php echo $row['vehicleName']; ?>" name="veiculo">
        </div>

        <div class="col-sm-1">
          
          <!-- trash icon -->
         
         <button class="btn btn-dark" name='btnDeleteSchedule'class="btn btn-dark" type='submit' value="btnDeleteSchedule">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
            </svg>
         </button>
        </form>

        <form action="./editSchedule.php" method="POST">
          <input type="text" value="<?php echo $row['cd_schedule']?>" name='cd_schedule' class="inputHidden" hidden>
          <input type="text" value="<?php echo $row['cd_person']?>" name='cd_person' class="inputHidden" hidden>
          <input type="text" value="<?php echo $email?>" name='email' class="inputHidden" hidden>
            <!-- edit icon -->
            <button name='btnEditSchedule'class="btn btn-dark mt-2" type='submit' value="btnEditSchedule">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
              </svg>
            </button>
          </form>
      </div>
      </div>
      <hr>
    <?php endforeach; ?>
    
    </div>
    <br>
    <div>
      <a class="btn btn-dark" href="../pages/login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
    </div>
    <br>
    <div>
      <a  class="btn btn-dark" href="../config/logout.php"><i class="bi bi-box-arrow-in-left"></i>  Sair </a>
    </div>
  </dialog>
  </div> 
</div>     
<div>
</div> 
</body>
</html>