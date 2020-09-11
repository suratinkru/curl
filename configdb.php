<?php


    // $host = "localhost";
    // $user = "suratin";
    // $password = "SuratinSuper6!";
    // $database = "noti";
    // $port = "3306";

    $host = "localhost";
    $user = "sammy";
    $password = "JakkritDev2020!";
    $database = "noti"; 
   
    




$conn = mysqli_connect( $host,$user,$password,$database);
mysqli_set_charset($conn, "utf8");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}