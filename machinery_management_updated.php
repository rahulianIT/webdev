<?php
include 'db.php';

// Function to add machinery
function addMachinery($name, $mimage, $description, $rental_price, $availability) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO machinery (name, mimage, description, rental_price, availability) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $mimage, $description, $rental_price, $availability);
    $stmt->execute();
    $stmt->close();
}

// Function to get all machinery
function getMachinery() {
    global $conn;
    $result = $conn->query("SELECT * FROM machinery");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to update machinery
function updateMachinery($machinery_id, $new_details) {
    global $conn;
    $stmt = $conn->prepare("UPDATE machinery SET name = ?, mimage = ?, description = ?, rental_price = ?, availability = ? WHERE id = ?");
    $stmt->bind_param("sssiii", $new_details['name'], $new_details['mimage'], $new_details['description'], $new_details['rental_price'], $new_details['availability'], $machinery_id);
    $stmt->execute();
    $stmt->close();
}

// Function to remove machinery
function removeMachinery($machinery_id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM machinery WHERE id = ?");
    $stmt->bind_param("i", $machinery_id);
    $stmt->execute();
    $stmt->close();
}

// Additional machinery management functions can be added here
?>
