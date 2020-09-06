<?php


    include_once('configdb.php'); 



$total = array(
    0 => array("date" => " 05/08/2020 15:22", "in" => "6666.35", "out" => "22.00", "info" => "ENET รับโอนจาก SCB x2242 นายภัทรพล รุ่งศรีเรือง"),
    1 => array("date" => " 05/08/2020 15:23", "in" => "6666.00", "out" => "22.00", "info" => "ENET รับโอนจาก SCB x2242 นางสาว ภัทรพล รุ่งศรีเรือง"),
    2 => array("date" => " 05/08/2020 15:23", "in" => "63.00", "out" => "22.00", "info" => "ENET รับโอนจาก SCB x2242 น.ส. ภัทรพล รุ่งศรีเรือง"),
    3 => array("date" => " 05/08/2020 15:23", "in" => "66622.00", "out" => "22.00", "info" => "ENET รับโอนจาก KBANK x2242"),
    4 => array("date" => " 05/08/2020 15:23", "in" => "6.00", "out" => "220.00", "info" => "ENET รับโอนจาก KTB x2242"),
    5 => array("date" => " 05/08/2020 15:23", "in" => "6.00", "out" => "22.00", "info" => "ENET รับโอนจาก (KBANK) x2242"),
    6 => array("date" => " 05/08/2020 15:23", "in" => "667.00", "out" => "22.00", "info" => "ENET รับโอนจาก SCB x2242 น.ส.ภัทรพล รุ่งศรีเรือง"),
    

);



// $mystring = 'น.ส.ภัทรพล';
// $findme   = 'น.ส.';
// $pos = strpos($mystring, $findme);


// if ($pos === false) {
//     echo "The string ";
// } else {
 
//     $first_name = mb_substr($mystring, 4, 30, 'UTF-8');
//    print_r($first_name);
// }


// print_r( preg_split("/[\s,()]+/", "(KBANK)") );
// print_r( explode(" ","ENET รับโอนจาก SCB x2242 นายภัทรพล รุ่งศรีเรือง") );


// insertdata($total,$conn);

$DataArrOld = array();
$newDataArr = array();
$datadiff = array();
$totolNew = array();

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
        // if(!empty($val[5])){
        //     $last_name = $val[5];
        // }else{
        //     $last_name = NULL;
        // }
        // if(!empty($val[6])){
        //     $last_name = $val[6];
        // }else{
        //     $last_name = NULL;
        // }

        
    }


    $checkdate = date('Y-m-d');
$result = mysqli_query($conn, "SELECT * FROM `scb` WHERE checkdate =  '$checkdate' &&  date = '$date'  &&  time = '$time' && amount = '$amount' && bk = '$bk'   ");


print_r($result->num_rows);
if($result->num_rows <= 0 ){
            $sql = "INSERT INTO `scb` (`id`, `title`, `date`, `time`, `amount`, `out`, `bk`, `acount`, `first_name`, `last_name`) 
        VALUES (NULL, 'curl', '$date ', '$time', '$amount', '$out ', '$bk', '$acount', '$first_name', '$last_name')";
 
         mysqli_query($conn, $sql); 
}
while ($row = mysqli_fetch_assoc($result)) {
             $date = $row['date'];
             print_r($date);
}




    // $newDataArr["date"] = $date;
    // $newDataArr["time"] = $time;
    // $newDataArr["amount"] = $amount;
    // // $newDataArr["out"] = $out;
    // $newDataArr["bk"] = $bk;
    // $newDataArr["acount"] = $acount;
    // $newDataArr["first_name"] = $first_name;
    // $newDataArr["last_name"] = $last_name;
    // $totolNew[] = $newDataArr;
}




// $checkdate = date('Y-m-d');
// $result = mysqli_query($conn, "SELECT * FROM `scb` WHERE checkdate =  '$checkdate' ");

// $totalOld = array();
// while ($row = mysqli_fetch_assoc($result)) {


//     $date = $row['date'];
//     $time = $row['time'];
//     $amount = $row['amount'];
//     $bk = $row['bk'];
//     $acount = $row['acount'];
//     $out = $row['out'];
//     $first_name = $row['first_name'];
//     $last_name = $row['last_name'];

//     $DataArrOld["date"] = $date;
//     $DataArrOld['time'] = $time;
//     $DataArrOld['amount'] = $amount;
//     // $DataArrOld['out'] = $out;
//     $DataArrOld['bk'] = $bk;
//     $DataArrOld['acount'] = $acount;
//     $DataArrOld['first_name'] = $first_name;
//     $DataArrOld['last_name'] = $last_name;
//     $totalOld[] = $DataArrOld;
// }

//  print_r("totalOld");
//  print_r($totalOld);
//  print_r("totolNew");
//  print_r($totolNew);

 

//  function array_diff_values($tab1, $tab2)
//  {
//     $result = array();
//     foreach($tab1 as $values) if(! in_array($values, $tab2)) $result[] = $values;
//     print_r($result);
//     return $result;
//  }

// $datadiff = array_diff_values($totolNew, $totalOld);
// print_r("datadiff");
// print_r($datadiff);


// $totalnewarray = array();
// foreach ($datadiff as $val) {

//     $date = $val['date'];
//     $time = $val['time'];
//     $amount = $val['amount'];
//     $out = $val['out'];
//     $bk = $val['bk'];
//     $acount = $val['acount'];
//     $first_name = $val['first_name'];
//     $last_name= $val['last_name'];
    
//         // $sql = "INSERT INTO scb (date, time,amount,out,bk,acount,first_name,last_name) values ";
//         // $sql .= implode(',', $totalnewarray);


//         // $sql = "INSERT INTO `scb` (`id`, `title`, `date`, `time`, `amount`, `out`, `bk`, `acount`, `first_name`, `last_name`) 
//         // VALUES (NULL, 'curl', '$date ', '$time', '$amount', '$out ', '$bk', '$acount', '$first_name', '$last_name')";
 
//         //  mysqli_query($conn, $sql); 

  
// }






// if (!empty($datadiff)) {


//     //    $post = [

//     //     'title'  => $title,
//     //     'date'   => $date,
//     //     'time'   => $time,
//     //     'amount' => $amount,
//     //     'bk'     => $bk,
//     //     'acount'  => $acount

//     // ];
//     // var_dump($post);
//     // $ch = curl_init('https://ea7e687fe34b.ngrok.io/affiliate/forward/app2.php');
//     // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//     // $response = curl_exec($ch);
//     // curl_close($ch);



//     $sql = "INSERT INTO scb (date, time,amount,out,bk,acount,first_name,last_name) values ";
//     $sql .= implode(',', $totalnewarray);
 
//     mysqli_query($conn, $sql); 
// }