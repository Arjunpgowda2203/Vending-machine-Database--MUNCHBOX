<?php
 session_start();

 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "vm_db";

 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }


if (isset($_POST['send'])) {

	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

    $machine_id=$_SESSION['machine_id'];
    $product_name=$_SESSION['product_name'];
    $num=$_POST['machine-selection'];
    $price=$_SESSION["price"];

    $int =(int) filter_var($num , FILTER_SANITIZE_NUMBER_INT);
    $int2 =(int) filter_var($price , FILTER_SANITIZE_NUMBER_INT);

    $total = $int*$int2;

    // echo "$total<br>";
    // echo "$machine_id";
	
    $_SESSION["total"]=$total;
    $_SESSION["machine_id"]=$machine_id;
    $_SESSION["product_name"]=$product_name;
    $_SESSION['quantity']=$num;

    header("location: transaction.php");

	}
    else{
		$error='eeeee';
		$_SESSION["error"] = $error;
		header("location: index.php");
		

	}

	$conn->close();

?>
