<?php


function insertbank($BANK_NAME,$USERNAME,$PASSWORD,$ACCOUNT_NAME,$ACCOUNT_NUMBER,$ACCOUNT_TYPE, $conn){
 

    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO bank (bank_name,username,password,account_name,account_number,account_type)
        VALUES ('$BANK_NAME', '$USERNAME', '$PASSWORD','$ACCOUNT_NAME','$ACCOUNT_NUMBER','$ACCOUNT_TYPE')";
        // use exec() because no results are returned
        $conn->exec($sql);

            
        
        $stmt = $conn->prepare("SELECT * FROM bank ORDER BY id DESC LIMIT 1");
        $stmt->execute();
   
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  
        $data['id'] = $result[0]['id'];

        $total = json_encode($data,JSON_UNESCAPED_UNICODE);  
        echo $total; 
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }

}

function updatebank($ID,$BANK_NAME,$USERNAME,$PASSWORD,$ACCOUNT_NAME,$ACCOUNT_NUMBER,$ACCOUNT_TYPE, $conn){

    try {
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE bank SET account_type='$ACCOUNT_TYPE', account_number='$ACCOUNT_NUMBER', bank_name='$BANK_NAME',username='$USERNAME',password='$PASSWORD',account_name='$ACCOUNT_NAME' where id= $ID";
            // Prepare statement
         $stmt = $conn->prepare($sql);
            // execute the query
         $stmt->execute();
         echo $stmt->rowCount() . " records UPDATED successfully";
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }

}

function deletebank($ID,$conn){

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // sql to delete a record
        $sql = "DELETE FROM bank where id= $ID";
        // use exec() because no results are returned
        $conn->exec($sql);
  echo "Record deleted successfully";
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }

}

function getbank($conn){
 
try {
  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM bank WHERE account_type Like '%scb%'");
    $stmt->execute();
    // set the resulting array to associative


    //  $result = $stmt->fetch();
    print_r($stmt->fetch());
     $data = array();
     $total = array();
     while ($row = $stmt->fetch()) {
      $data['id'] = $row['id'];
      $data['bank_name'] = $row['bank_name'];
      $data['username'] = $row['username'];
      $data['password'] = $row['password'];
      $data['account_name'] = $row['account_name'];
      $data['account_number'] = $row['account_number'];
      $data['account_type'] = $row['account_type'];
      $data['created_at'] = $row['created_at'];
      $data['updated_at'] = $row['updated_at'];
      $total[] = $data;

  }


     $total = json_encode($total,JSON_UNESCAPED_UNICODE);  
     echo $total; 



  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

function usebank($conn){
 
    try {
      
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM bank WHERE account_type Like '%SCB%'");
        $stmt->execute();
   
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return  $result;
     
    
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    
