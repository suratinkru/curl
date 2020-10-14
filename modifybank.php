<?php


function insertbank($BANK_NAME,$USERNAME,$PASSWORD,$ACCOUNT_NAME, $conn){

    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO bank (bank_name,username,password,account_name)
        VALUES ('$BANK_NAME', '$USERNAME', '$PASSWORD','$ACCOUNT_NAME')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }

}

function updatebank($ID,$BANK_NAME,$USERNAME,$PASSWORD,$ACCOUNT_NAME, $conn){

    try {
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE bank SET bank_name='$BANK_NAME',username='$USERNAME',password='$PASSWORD',account_name='$ACCOUNT_NAME' where id= $ID";
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
    $stmt = $conn->prepare("SELECT * FROM bank");
    $stmt->execute();
    // set the resulting array to associative


    //  $result = $stmt->fetch();
     $data = array();
     $total = array();
     while ($row = $stmt->fetch()) {
      $data['id'] = $row['id'];
      $data['bank_name'] = $row['bank_name'];
      $data['username'] = $row['username'];
      $data['password'] = $row['password'];
      $data['account_number'] = $row['account_name'];
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
        $stmt = $conn->prepare("SELECT * FROM bank ORDER BY id DESC LIMIT 1");
        $stmt->execute();
   
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return  $result;
     
    
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    
