<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $farmer_id = $_POST['farmer_id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'farmer'");
    $stmt->bind_param("i", $farmer_id);
    
    if ($stmt->execute()) {
        echo "Farmer removed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
