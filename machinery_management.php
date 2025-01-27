<?php
include 'db.php';

// Function to add machinery
function addMachinery($name, $type, $rental_price) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO machinery (name, type, rental_price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $type, $rental_price);
    $stmt->execute();
    $stmt->close();
}

// Function to get all machinery
function getMachinery() {
    global $conn;
    $result = $conn->query("SELECT * FROM machinery");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to update machinery quantity
function updateMachineryQuantity($machinery_id, $quantity) {
    global $conn;
    $stmt = $conn->prepare("UPDATE machinery SET quantity = quantity - ? WHERE id = ?");
    $stmt->bind_param("ii", $quantity, $machinery_id);
    $stmt->execute();
    $stmt->close();
}

// Function to update machinery
function updateMachinery($machinery_id, $new_details) {
    global $conn;
    $stmt = $conn->prepare("UPDATE machinery SET name = ?, type = ?, rental_price = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $new_details['name'], $new_details['type'], $new_details['rental_price'], $machinery_id);
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

<!-- Footer Start -->
<?php include 'footer.php'; ?>
