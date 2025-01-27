<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $worker_id = $_POST['worker_id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'worker'");
    $stmt->bind_param("i", $worker_id);
    
    if ($stmt->execute()) {
        echo "Worker removed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
