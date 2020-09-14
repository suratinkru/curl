<?php

$host = "localhost";
 $user = "sammy";
 $password = "JakkritDev2020!";
 $database = "noti"; 




 $conn = mysqli_connect( $host,$user,$password,$database);
 mysqli_set_charset($conn, "utf8");
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }


$total = array(
    0 => array("date" => " 01/08/2020 15:22", "in" => "10.35", "out" => "22.00", "info" => "ENET รับโอนจาก SCB x2242 นายภัทรพล รุ่งศรีเรือง"),

    
);


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

foreach ($total as $val) {
    $travelDates = date('Y-m-d H:i:s', strtotime($val['date']));
    $travelDates = preg_split("/[\s,]+/", $travelDates);
    $datetime =  $travelDates;
    $date = date('m/d', strtotime($datetime[0]));
    $time = mb_substr($datetime[1], 0, 5, 'UTF-8');
    $amount = $val['in'];
    $out = $val['out'];
    $info = $val['info'];
    $arrayinfo[] = explode(" ", $info);

    foreach ($arrayinfo as $val) {

            $findme   = '(';
            $pos = strpos( $val[2],$findme );
            if ($pos === false) {
                $bk = $val[2];
            } else {
            
                $bk1 = preg_split("/[\s,()]+/", $val[2]);
                $bk = $bk1[1];
            }
     
        $acount = $val[3];
        if(!empty($val[4]) ){
           
            if($val[4] === "นาย" || $val[4] === "นางสาว" || $val[4] === "น.ส."){
                $first_name = $val[5];
                $last_name = $val[6];
            }else{

                $findme   = 'น.ส.';
                $pos = strpos($val[4], $findme);


                if ($pos === false) {

                    $findman   = 'นาย';
                    $posm = strpos($val[4], $findman);
    
                    if ($posm === false) {
                        $first_name = $val[4];
                  
                    } else {
                    
                        $first_name = mb_substr($val[4], 3, 30, 'UTF-8');
                  
                    }
                  
                } else {
                
                    $first_name = mb_substr($val[4], 4, 30, 'UTF-8');
          
                }

               
                $last_name = $val[5];
            }
        }else{
            $first_name = NULL;
            $last_name = NULL;
        }
       
    }
 
         $checkdate = date('Y-m-d');
         $result = mysqli_query($conn, "SELECT * FROM `scb` WHERE checkdate =  '$checkdate' &&  date = '$date'  &&  time = '$time' && amount = '$amount' && bk = '$bk' && first_name = '$first_name' && last_name = '$last_name' ");


         if($result->num_rows <= 0 ){

            $sql = "INSERT INTO `scb` (`id`, `title`, `date`, `time`, `amount`, `out`, `bk`, `account`, `first_name`, `last_name`,`checkdate`) 
            VALUES (NULL, 'curl', '$date ', '$time', '$amount', '$out ', '$bk', '$acount', '$first_name', '$last_name' ,'$checkdate')";
 
            mysqli_query($conn, $sql); 


}
}
?>