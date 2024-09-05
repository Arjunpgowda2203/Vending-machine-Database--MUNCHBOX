<?php
session_start();

if(isset($_POST['send'])) {
    $connection = mysqli_connect('localhost', 'root', '', 'vm_db');

    // Retrieve session variables
    $product_id = $_SESSION['product_id'];
    $machine_id = $_SESSION['machine_id'];
    $total = $_SESSION['total'];
    $username = $_SESSION['username'];
    $quantity = $_SESSION['quantity']; 

    // Prepare and bind parameters for the SQL UPDATE statement
    $sql_update = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?";
    $stmt_update = $connection->prepare($sql_update);
    $stmt_update->bind_param("ii", $int, $product_id); // Assuming product_id is an integer
    $int = (int) filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);
    $stmt_update->execute();

    // Prepare and execute the INSERT statement for orders
    $date_time = date('Y-m-d H:i:s');
    $request = "INSERT INTO orders (username, order_date_time, total_amount, machine_id, product_id) VALUES (?, ?, ?, ?, ?)";
    $stmt_order = $connection->prepare($request);
    $stmt_order->bind_param("ssiii", $username, $date_time, $total, $machine_id, $product_id);
    $stmt_order->execute();

    // Redirect to success page
    header("location: success.php");
    
} else {
    $error = 'eeeee';
    $_SESSION["error"] = $error;
    header("location: transaction.php");
    
}
?>
