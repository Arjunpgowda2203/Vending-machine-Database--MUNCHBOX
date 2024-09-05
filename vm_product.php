<?php
session_start();

   $conn = mysqli_connect('localhost','root','','vm_db');

    $sql = 'SELECT * From products WHERE product_name = "' . $_SESSION["product"] . '"';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
  
                  $_SESSION['machine_id'] = $row['machine_id'];
                  $_SESSION['product_name'] = $row['product_name'];
                  $_SESSION['product_id'] = $row['product_id'];
                  $_SESSION[ 'price' ]= $row['price'];

                  // $_SESSION["login"]="false";
                  header("location: order.php");
            
        }
      } else{
        echo "$result->num_rows";
        //   $error='eeeee';
        //   $_SESSION["error"] = $error;
        //   header("location: index.php");
          
  
      }

?>  