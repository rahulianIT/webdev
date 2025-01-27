<?php
session_start();
include 'db.php';

if (isset($_POST['buy_now'])) {
    // Check if the cart is empty
    $check_cart_query = "SELECT COUNT(*) AS count FROM cart";
    $check_cart_result = $conn->query($check_cart_query);
    $cart_count = $check_cart_result->fetch_assoc()['count'];

    if ($cart_count == 0) {
        echo "Your cart is empty. Please add items to your cart before proceeding.";
        exit();
    }

    $query = "SELECT SUM(p.price * c.quantity) AS total FROM cart c JOIN products p ON c.product_id = p.pid";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $query = "INSERT INTO orders (total) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("d", $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $query = "INSERT INTO order_items (order_id, product_id, quantity, price)
              SELECT ?, c.product_id, c.quantity, p.price
              FROM cart c JOIN products p ON c.product_id = p.id";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    // Update product quantities
    $cart_items_query = "SELECT c.product_id, c.quantity FROM cart c";
    $cart_items_result = $conn->query($cart_items_query);
    $cart_items = $cart_items_result->fetch_all(MYSQLI_ASSOC);

    $update_query = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    foreach ($cart_items as $item) {
        $update_stmt->bind_param("ii", $item['quantity'], $item['product_id']);
        $update_stmt->execute();
    }

    $conn->query("DELETE FROM cart");

    echo "Order placed successfully!";
}
