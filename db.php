<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "shetkari_raja"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get all farmers
function getFarmers() {
    global $conn;
    $sql = "SELECT * FROM farmers";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get all machinery
function getMachinery() {
    global $conn;
    $sql = "SELECT * FROM machinery";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get all workers
function getWorkers() {
    global $conn;
    $sql = "SELECT * FROM workers";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get all products
function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to save bill to database
function saveBillToDatabase($user_id, $order_details, $total_amount) {
    global $conn;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bills (user_id, total_amount) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total_amount);
    $stmt->execute();
    $bill_id = $stmt->insert_id; // Get the last inserted bill ID

    // Insert order details
    foreach ($order_details as $item) {
        $stmt = $conn->prepare("INSERT INTO bill_items (bill_id, product_id, name, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisd", $bill_id, $item['product_id'], $item['name'], $item['price']);
        $stmt->execute();
    }

    return $bill_id; // Return the bill ID
}
?>
