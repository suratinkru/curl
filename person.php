<?php
require_once 'configdb.php';

$sql = "INSERT INTO `Persons` ( `name`) 
VALUES ( 'curl')";

 mysqli_query($conn, $sql); 