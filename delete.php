<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDERS</title>
    <style>
        body{
            background-color: rgb(119,158,238);
        }
        div{
            background-color:rgba(228, 223, 223,0.5);
            height: 800px;
            width: 1245px;
            box-shadow:  0px 0px 20px rgba(0,0,0,0.4);
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .delete-btn {
            background-color: #ff0000;
            color: #fff;
            padding: 6px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>ORDERS</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="orders-table-body">
    
            </tbody>
        </table>
    </div>

    <script>
        // Function to fetch orders data from the server
        function fetchOrders() {
            fetch('fetch_orders.php')
            .then(response => response.json())
            .then(data => {
                populateOrdersTable(data);
            })
            .catch(error => {
                console.error('Error fetching orders:', error);
            });
        }

        // Function to populate the table with orders data
        function populateOrdersTable(ordersData) {
            const ordersTableBody = document.getElementById("orders-table-body");
            // Clear existing table rows
            ordersTableBody.innerHTML = '';

            // Loop through orders data and create table rows
            ordersData.forEach(order => {
                const quantity = order.total_amount / order.price
                const row = `
                    <tr>
                        <td>${order.order_id}</td>
                        <td>${order.username}</td>
                        <td>${order.product_name}</td>
                        <td>${quantity}</td>
                        <td>${order.total_amount}</td>
                        <td><button onclick="deleteOrder(${order.order_id},${quantity})">Delete</button></td>
                    </tr>
                `;
                ordersTableBody.innerHTML += row;
            });
        }

        function deleteOrder(order_id, quantity) {
        if (confirm("Are you sure you want to delete this order?")) {
            fetch('delete_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ order_id: order_id, quantity: quantity }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Order deleted successfully!");
                    // Update the table after successful deletion
                    fetchOrders();
                } else {
                    alert("Failed to delete order.");
                }
            })
            .catch(error => {
                console.error('Error deleting order:', error);
                alert("An error occurred while deleting the order.");
            });
        }
        }

        // Populate the table initially
        fetchOrders();
    </script>
</body>
</html>
