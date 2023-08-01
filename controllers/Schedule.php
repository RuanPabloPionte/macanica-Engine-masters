<?php

use phpDocumentor\Reflection\Location;
session_start();

require('../classes/Schedule.php');

$schedule = new Schedule();
extract($_POST);





if (isset($_POST['btnDeleteSchedule'])){
    $schedule->deleteScheduleId($cd_schedule);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");
    echo 'Delete';
}else if(isset($_POST['agendar'])){
    
    $cd_person = $_POST['cd_person'];
    $servece = $_POST['servece'];
    $dt_atendimento = $_POST['dt_atendimento'];
    $V_plate = $_POST['V_plate'];

    $schedule->createSchedule($cd_person,$servece, $V_plate);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");
}else if(isset($_POST['btnEditSchedule'])){
    $cd_schedule = $_POST['cd_schedule'];
    $cd_servece = $_POST['servece'];
    $cd_person = $_POST['cd_person'];
    $V_plate = $_POST['V_plate'];
    $schedule->updateSchedule($cd_schedule, $cd_person,$cd_servece, $V_plate);
    Header("Location: http://localhost/PROJECTS/mecanica/pages/agendar.php");  
    
}

?>
