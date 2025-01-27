<?php
session_start();
include 'db.php';

if (isset($_POST['machinery_id'])) {
    $machinery_id = $_POST['machinery_id'];

    // Check if the machinery is already in the cart
    $check_query = "SELECT * FROM machinery_cart WHERE machinery_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $machinery_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If already in cart, update the quantity
        $update_query = "UPDATE machinery_cart SET quantity = quantity + 1 WHERE machinery_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $machinery_id);
        $update_stmt->execute();
    } else {
        // If not in cart, add it
        $insert_query = "INSERT INTO machinery_cart (machinery_id, quantity) VALUES (?, 1)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("i", $machinery_id);
        $insert_stmt->execute();
    }

    echo "Machinery added to cart successfully!";
} else {
    echo "No machinery ID provided.";
}
?>
