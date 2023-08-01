<?php

session_start();
require('../classes/Person.php');
$person = new Person();
print_r($_REQUEST);
$person->testLogin();
?>