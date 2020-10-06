<?php
require_once 'configdb.php';



$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM `scb` WHERE checkdate =  '2020-10-01' &&  date = '01/10/2020'  &&  time = '11:13' && amount = '0.09' && bk = 'KTB' && account = 'X655137' && first_name = '' && last_name = '' ");


$stmt->execute();

$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        print_r($result);

        if($result == null){
            print_r("ok");
        }else{
            print_r("e");
        }



