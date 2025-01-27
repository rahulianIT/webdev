<?php
session_start();
include 'db.php';
// Display header
include 'header.php';
echo "Farmer ID: " . htmlspecialchars($_SESSION['fid']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Rent a Worker</title>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <main>
        <h1>Rent a Worker</h1>
        <form method="POST" action="">
            <label for="worker_id">Worker ID:</label>
            <input type="text" id="worker_id" name="worker_id" required><br><br>
            <label for="duration">Rental Duration (hours):</label>
            <input type="number" id="duration" name="duration" required><br><br>
            <label for="notes">Notes:</label>
            <textarea id="notes" name="notes"></textarea><br><br>
            <input type="submit" value="Rent Worker" class="button-icon" onclick="showAlert('Rental request submitted!');">
        </form>

        <?php
        // Get the worker ID and rental duration from the request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $worker_id = $_POST['worker_id'];
            $rental_duration = $_POST['duration'];
           
            $user_id = $_SESSION['fid'];
            $rental_date = date('Y-m-d H:i:s');
            $notes = $_POST['notes'];

            // Validate input
            if (empty($worker_id) || empty($rental_duration)) {
                echo "Worker ID and rental duration are required.";
                exit();
            }

            // Insert rental request into the database
            $insert_query = "INSERT INTO worker_rentals (farmer_id, worker_id, rental_duration, rental_date, notes) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("iiiss", $user_id, $worker_id, $rental_duration, $rental_date, $notes);

            if ($insert_stmt->execute()) {
                echo "Successfully rented worker with ID: " . htmlspecialchars($worker_id) . " for " . htmlspecialchars($rental_duration) . " hours!";
            $rented_amount = $rental_duration * 70;
            echo " The total amount is: Rs. " . htmlspecialchars($rented_amount) . ".";
            } else {
                echo "Error renting worker: " . $conn->error;
            }

            $insert_stmt->close();
            $conn->close();
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
</body>
</html>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
