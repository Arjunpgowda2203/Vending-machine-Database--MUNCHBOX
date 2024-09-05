<?php
 session_start();
if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "login.php")) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "vm_db";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}


	$sql = 'SELECT * FROM customers WHERE username = "' . $_POST["username"] . '"';
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {

	  while($row = $result->fetch_assoc()) {
		  if (($row["password"] === $_POST["password"]) and ($row["username"] === $_POST["username"])){

                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];

                header("location: index.php");
		  }
	  }
	} else{
		// echo "$result->num_rows";
		$error='eeeee';
		$_SESSION["error"] = $error;
		header("location: login.php");
		

	}
	$conn->close();
	}


?>
 


