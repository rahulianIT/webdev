<?php
session_start();
include 'db_connection.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $query = "SELECT o.id, o.total, o.created_at, p.name, oi.quantity, oi.price
              FROM orders o
              JOIN order_items oi ON o.id = oi.order_id
              JOIN products p ON oi.product_id = p.id
              WHERE o.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h1>Receipt</h1>";
    echo "<p>Order ID: " . $order_id . "</p>";

    // Fetch the first row to get the created_at date
    if ($row = $result->fetch_assoc()) {
        echo "<p>Date: " . $row['created_at'] . "</p>";
        echo "<table border='1'>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>";

        do {
            echo "<tr>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>" . $row['price'] . "</td>
                  </tr>";
        } while ($row = $result->fetch_assoc());

        echo "</table>";
        echo "<p>Total: " . $row['total'] . "</p>";
    } else {
        echo "<p>No details found for this order.</p>";
    }

    $stmt->close();
}
?>
