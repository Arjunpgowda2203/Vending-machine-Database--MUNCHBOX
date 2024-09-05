 <?php

   $connection = mysqli_connect('localhost','root','','vm_db');

   if(isset($_POST['send'])){
      $username = $_POST['username'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $request = " insert into customers(username, name, email, password) values('$username','$name','$email','$password') ";
      mysqli_query($connection, $request);

      header('location:login.php'); 

   }else{
      echo 'something went wrong please try again!';
   }

?> 
<!-- 
<?php
$connection = mysqli_connect('localhost', 'root', '', 'vm_db');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to add trigger
$add_trigger_query = "DELIMITER //
                      CREATE TRIGGER after_customer_insert
                      AFTER INSERT ON customers
                      FOR EACH ROW
                      BEGIN
                          INSERT INTO audit_table (action, customer_id, timestamp)
                          VALUES ('insert', NEW.id, NOW());
                      END;
                      //
                      DELIMITER ;";

// Execute add trigger query
if (mysqli_multi_query($connection, $add_trigger_query)) {
    header('location:login.php'); 
} else {
    echo "Error adding trigger: " . mysqli_error($connection);
}

// Close connection
mysqli_close($connection);
?> -->
