<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS vm_db";
if ($conn->multi_query($sql) !== TRUE) {
  echo "Error creating database: " . $conn->error;
}

$conn->close();

$dbname = "vm_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS customers (
username VARCHAR(30) PRIMARY KEY COLLATE latin1_bin,
name VARCHAR(255),
email VARCHAR(255),
password VARCHAR(30) NOT NULL COLLATE latin1_bin,
);";

if ($conn->multi_query($sql) !== TRUE) {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vm_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS product_type (
product_type_id INT(30) PRIMARY KEY,
type_name VARCHAR(255),
);";

if ($conn->multi_query($sql) !== TRUE) {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vm_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS machines (
machine_id INT(30) PRIMARY KEY,
location VARCHAR(255),
);";

if ($conn->multi_query($sql) !== TRUE) {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vm_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS products (
product_id INT(30) PRIMARY KEY,
product_name VARCHAR(255),
price INT(30),
product_type_id INT(30),
stock_quantity INT(30),
FOREIGN KEY (product_type_id) REFERENCES product_type(product_type_id)
machine_id INT(30),
FOREIGN KEY  (machine_id) REFERENCES machines(machine_id)
);";

if ($conn->multi_query($sql) !== TRUE) {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vm_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS orders (
order_id INT(30) PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(30),
(username) REFERENCES customers(username) ,
order_date_time DATETIME,
total_amount INT(30),
machine_id  INT(30),
FOREIGN KEY (machine_id) REFERENCES machine(machine_id)
product_name  VARCHAR(255),
(product_name) REFERENCES products(product_name)
);";

if ($conn->multi_query($sql) !== TRUE) {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>