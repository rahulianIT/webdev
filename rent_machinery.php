<?php
session_start();
include 'db.php';
// Display header
include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Rent Machinery</title>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <main>
        <h1>Rent Machinery</h1>
        <form method="POST" action="">
            <label for="machinery_id">Machinery ID:</label>
            <input type="text" id="machinery_id" name="machinery_id" required><br><br>
            <label for="farmer_id">Farmer ID:</label>
            <input type="text" id="farmer_id" name="farmer_id" value="<?php echo $_SESSION['fid']; ?>" readonly><br><br>
            <label for="rental_date">Rental Date:</label>
            <input type="datetime-local" id="rental_date" name="rental_date" required><br><br>
            <label for="return_date">Return Date:</label>
            <input type="datetime-local" id="return_date" name="return_date" required><br><br>
            <label for="rental_price">Rental Price:</label>
            <input type="number" id="rental_price" name="rental_price" required><br><br>
            <label for="notes">Notes:</label>
            <textarea id="notes" name="notes"></textarea><br><br>
            <input type="submit" value="Rent Machinery" class="button-icon" onclick="showAlert('Rental request submitted!');">
        </form>

        <?php
        // Process the rental request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $machinery_id = $_POST['machinery_id'];
            $farmer_id = $_SESSION['fid'];
            $rental_date = $_POST['rental_date'];
            $return_date = $_POST['return_date'];
            $rental_price = $_POST['rental_price'];
            $notes = $_POST['notes'];
            $rental_start = new DateTime($rental_date);
            $rental_end = new DateTime($return_date);
            $interval = $rental_start->diff($rental_end);
            $rental_duration = $interval->h + ($interval->days * 24);
            // Validate input
            if (empty($machinery_id) || empty($rental_duration) || empty($rental_date) || empty($return_date) || empty($rental_price)) {
                echo "All fields are required.";
                exit();
            }

            // Insert rental request into the database
           
            $insert_query = "INSERT INTO rentals (machinery_id, farmer_id, rental_date, return_date, rental_price, duration, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $total_amount = $rental_price * $rental_duration; // Calculate total amount
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("iissiii", $machinery_id, $farmer_id, $rental_date, $return_date, $rental_price, $rental_duration, $total_amount);

            if ($insert_stmt->execute()) {
                echo "Successfully rented machinery with ID: " . htmlspecialchars($machinery_id) . " for " . htmlspecialchars($rental_duration) . " hours!";
            } else {
                echo "Error renting machinery: " . $conn->error;
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
