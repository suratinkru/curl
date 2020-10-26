<?php


    // $host = "localhost";
    // $user = "root";
    // $password = "";
    // $database = "noti";


//     $host = "localhost";
//     $user = "sammy";
//     $password = "JakkritDev2020!";
//     $database = "gateway"; 
   
    
// $conn = mysqli_connect($host,$user,$password,$database);
// mysqli_set_charset($conn, "utf8");
// if (mysqli_connect_errno()) {
//     echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }

//test
// $servername = "localhost";
// $username = "root";
// $password = "";
//$database = "noti"; 


$servername = "localhost";
$username = "sammy";
$password = "JakkritDev2020!";
$database = "gateway"; 


try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}