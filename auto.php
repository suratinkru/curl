<?php
function insertdata($total,$conn){

foreach ($total as $val) {
   // $travelDates = date('Y-m-d H:i:s', strtotime($val['date']));
    $travelDates = preg_split("/[\s,]+/", $val['date']);
    $datetime =  $travelDates;
    $date = $datetime[0];
    $time = $datetime[1];
    $amount = $val['in'];
    $out = $val['out'];
    $info = $val['info'];
    $arrayinfo[] = explode(" ", $info);

    foreach ($arrayinfo as $val) {

        $findbk   = 'PromptPay';
        $pos = strpos( $val[1],$findbk );
        if ($pos !== false) {
            $bk = $val[1];
            $acount = $val[2];
            $first_name = $val[4];
            $last_name = $val[5];

        } else {

              
            $findme   = '(';
            $pos = strpos( $val[2],$findme );
            if ($pos === false) {
                $bk = $val[2];
            } else {
            
                $bk1 = preg_split("/[\s,()]+/", $val[2]);
                $bk = $bk1[1];
            }

            $findsl = '/';
            $possl = strpos( $val[3],$findsl);
            if ($possl === false) {
                $acount = $val[3];
            } else {
            
                $acount1 = preg_split("/[\s,\/]+/", $val[3]);
             
                $acount = $acount1[1];
            }

     
     
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

           
       
    }
 
  
    $checkdate = date('Y-m-d');
    $result = mysqli_query($conn, "SELECT * FROM `scb` WHERE checkdate =  '$checkdate' &&  date = '$date'  &&  time = '$time' && amount = '$amount' && bk = '$bk' && first_name = '$first_name' && last_name = '$last_name' ");


if($result->num_rows <= 0 ){

            $sql = "INSERT INTO `scb` (`id`, `title`, `date`, `time`, `amount`, `out`, `bk`, `account`, `first_name`, `last_name`,`checkdate`) 
        VALUES (NULL, 'curl', '$date ', '$time', '$amount', '$out ', '$bk', '$acount', '$first_name', '$last_name' ,'$checkdate')";
 
         mysqli_query($conn, $sql); 

 
         $post = [

            'title'  => 'curl',
            'date'   => $date,
            'time'   => $time,
            'amount' => $amount,
            'transfer_from_bank'    => $bk,
            'bank_account_number'  => $acount,
            'first_name'  => $first_name,
            'last_name'  => $last_name,
            'hash_key' => '4jMmPayt0DPJIJkg5pEPG4ZmeJPed91E'
   

        ];
   
           $data = json_encode($post,JSON_UNESCAPED_UNICODE);                                                                              
        $url = 'http://128.199.94.1:4000/api/deposit/curl';
        print_r($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        print_r ($result);

    }

}
}



