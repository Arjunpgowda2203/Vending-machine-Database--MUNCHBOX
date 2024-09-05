<?php

$connection = mysqli_connect('localhost','root','','vm_db');

if(isset($_POST['send'])){
   $productname = $_POST['productName'];
   $productid = $_POST['productid'];
   $machineid = $_POST['machineID'];
   $type = $_POST['productType'];
   $price = $_POST['productPrice'];
   $stock = $_POST['productStock'];


   $request = " insert into products(product_id, product_name, price, product_type_id, stock_quantity, machine_id) values('$productid','$productname','$price','$type','$stock','$machineid') ";
   mysqli_query($connection, $request);

   header('location:admin.php'); 

}else{
   echo 'something went wrong please try again!';
}

?> 