<?php
// realiza o logout da sessão
session_start();

require('../classes/Person.php');

$person = new Person();
$person->logut();

?>
