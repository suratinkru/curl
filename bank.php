<?php
require_once 'configdb.php';
require_once 'modifybank.php';

$BANK_NAME = $_POST['bank_name'];
$USERNAME =  $_POST['username'];
$PASSWORD = $_POST['password'];
$ACCOUNT_NUMBER =  $_POST['account_number'];
$ACCOUNT_NAME =  $_POST['account_name'];
$ACCOUNT_TYPE =  $_POST['account_type'];
$ID =  $_POST['id'];

$CRUD =  $_POST['crud'];
$HAS_KEY =  $_POST['has_key'];


$updatebank = 1;
$insertbank = 2;
$deletebank = 3;
$getbank = 4;
$has_key = $HAS_KEY;

if (md5($has_key) === '637e35acf4b87f919b859c6ff33bcd19') {

    if($insertbank == $CRUD){    
 
        insertbank($BANK_NAME,$USERNAME,$PASSWORD,$ACCOUNT_NAME,$ACCOUNT_NUMBER,$ACCOUNT_TYPE, $conn);
    }
    
    
    if($updatebank == $CRUD){
        updatebank($ID,$BANK_NAME,$USERNAME,$PASSWORD,$ACCOUNT_NAME,$ACCOUNT_NUMBER,$ACCOUNT_TYPE, $conn);
    }
    
    
    if($deletebank == $CRUD){
        deletebank($ID,$conn);
    }

    if($getbank == $CRUD){
        getbank($conn);
    }

}else{
    echo "key invalid";
}








