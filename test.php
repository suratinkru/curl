<?php

// $host = "localhost";
//  $user = "sammy";
//  $password = "JakkritDev2020!";
//  $database = "noti"; 




//  $conn = mysqli_connect( $host,$user,$password,$database);
//  mysqli_set_charset($conn, "utf8");
//  if (mysqli_connect_errno()) {
//  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//  }


$total = array(
    // 0 => array("date" => "22/09/2020 10:21", "in" => "1", "out" => "0", "info" => "ENET กรุงไทย (KTB) /X655137"),
    0 => array("date" => "22/09/2020 10:21", "in" => "1", "out" => "0", "info" => "ENET PromptPay x3044 นาย ภัทรพล รุ่งศรีเรือง"),
    1 => array("date" => "23/09/2020 10:21", "in" => "1.50", "out" => "0", "info" => "ENET PromptPay x3044 นาย ภัทรพล รุ่งศรีเรือง"),

    
);


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$accountnumber = 'accountnumber';
$amounttotal = 'amounttotal';
$amountbalance = 'amountbalance';


foreach ($total as $val) {
   
$val['accountnumber']= $accountnumber;
$val['amounttotal']= $amounttotal;
$val['amountbalance']= $amountbalance;
print_r($val);
}

// $acountmoney = array();
// $total[0]['accountnumber']= 'test1';
// $total[0]['amounttotal']= 'amounttotal';
// $total[0]['amountbalance']= 'amountbalance';
// $total[] = $acountmoney;


// foreach ($total as $val) {
//     // $travelDates = date('Y-m-d H:i:s', strtotime($val['date']));
//     $travelDates = preg_split("/[\s,]+/", $val['date']);
 
//     $datetime =  $travelDates;
//     $date = $datetime[0];
//     $time = $datetime[1];
//     $amount = $val['in'];
//     $out = $val['out'];
//     $info = $val['info'];
//     $arrayinfo[] = explode(" ", $info);
   

//     foreach ($arrayinfo as $val) {


//         $findbk   = 'PromptPay';
//         $pos = strpos( $val[1],$findbk );
//         if ($pos !== false) {
//             $bk = $val[1];
//             $acount = $val[2];
//             $first_name = $val[4];
//             $last_name = $val[5];

//         } else {

              
//             $findme   = '(';
//             $pos = strpos( $val[2],$findme );
//             if ($pos === false) {
//                 $bk = $val[2];
//             } else {
            
//                 $bk1 = preg_split("/[\s,()]+/", $val[2]);
//                 $bk = $bk1[1];
//             }

//             $findsl = '/';
//             $possl = strpos( $val[3],$findsl);
//             if ($possl === false) {
//                 $acount = $val[3];
//             } else {
            
//                 $acount1 = preg_split("/[\s,\/]+/", $val[3]);
             
//                 $acount = $acount1[1];
//             }

     
     
//         if(!empty($val[4]) ){
           
//             if($val[4] === "นาย" || $val[4] === "นางสาว" || $val[4] === "น.ส."){
//                 $first_name = $val[5];
//                 $last_name = $val[6];
//             }else{

//                 $findme   = 'น.ส.';
//                 $pos = strpos($val[4], $findme);


//                 if ($pos === false) {

//                     $findman   = 'นาย';
//                     $posm = strpos($val[4], $findman);
    
//                     if ($posm === false) {
//                         $first_name = $val[4];
                  
//                     } else {
                    
//                         $first_name = mb_substr($val[4], 3, 30, 'UTF-8');
                  
//                     }
                  
//                 } else {
                
//                     $first_name = mb_substr($val[4], 4, 30, 'UTF-8');
          
//                 }

               
//                 $last_name = $val[5];
//             }
//         }else{
//             $first_name = NULL;
//             $last_name = NULL;
//         }
        
           
//         }

           

           
          
       
//     }

//     print_r($date);
//     echo '<br/>';
//     print_r($time);
//     echo '<br/>';
//     print_r($amount);
//     echo '<br/>';
//     print_r($bk);
//     echo '<br/>';
//     print_r($acount);
//     echo '<br/>';
//     print_r($first_name);
//     echo '<br/>';
//     print_r($last_name);
//     echo '<br/>';
//     echo '<br/>';
//     echo '<br/>';
//     echo '<br/>';
//     echo '<br/>';
 
        //  $checkdate = date('Y-m-d');
        //  $result = mysqli_query($conn, "SELECT * FROM `scb` WHERE checkdate =  '$checkdate' &&  date = '$date'  &&  time = '$time' && amount = '$amount' && bk = '$bk' && first_name = '$first_name' && last_name = '$last_name' ");


        //  if($result->num_rows <= 0 ){

        //     $sql = "INSERT INTO `scb` (`id`, `title`, `date`, `time`, `amount`, `out`, `bk`, `account`, `first_name`, `last_name`,`checkdate`) 
        //     VALUES (NULL, 'curl', '$date ', '$time', '$amount', '$out ', '$bk', '$acount', '$first_name', '$last_name' ,'$checkdate')";
 
        //     mysqli_query($conn, $sql); 


    //    }
// }
?>