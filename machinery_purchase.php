<?php
session_start();
include 'db.php';

if (isset($_POST['buy_machinery'])) {
    // Check if the cart is empty
    $check_cart_query = "SELECT COUNT(*) AS count FROM machinery_cart";
    $check_cart_result = $conn->query($check_cart_query);
    $cart_count = $check_cart_result->fetch_assoc()['count'];

    if ($cart_count == 0) {
        echo "Your cart is empty. Please add machinery to your cart before proceeding.";
        exit();
    }

    $query = "SELECT SUM(m.price * c.quantity) AS total FROM machinery_cart c JOIN machinery m ON c.machinery_id = m.id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $query = "INSERT INTO orders (total) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("d", $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $query = "INSERT INTO order_items (order_id, machinery_id, quantity, price)
              SELECT ?, c.machinery_id, c.quantity, m.price
              FROM machinery_cart c JOIN machinery m ON c.machinery_id = m.id";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    // Update machinery quantities
    $cart_items_query = "SELECT c.machinery_id, c.quantity FROM machinery_cart c";
    $cart_items_result = $conn->query($cart_items_query);
    $cart_items = $cart_items_result->fetch_all(MYSQLI_ASSOC);

    $update_query = "UPDATE machinery SET quantity = quantity - ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    foreach ($cart_items as $item) {
        $update_stmt->bind_param("ii", $item['quantity'], $item['machinery_id']);
        $update_stmt->execute();
    }

    $conn->query("DELETE FROM machinery_cart");

    echo "Machinery order placed successfully!";
}
?>
