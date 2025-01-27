<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Rented Items</title>
</head>
<body>
    <main>
        <h1>Rented Items</h1>
        <?php
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ../html/login.html");
            exit();
        }

        include 'db.php';

        // Fetch rented machinery details
        $machinery_query = "SELECT m.name AS machinery_name, u.username AS user_name, r.rental_date, r.return_date, r.rental_price 
                            FROM rentals r 
                            JOIN machinery m ON r.machinery_id = m.id 
                            JOIN users u ON r.user_id = u.id";
        $machinery_result = $conn->query($machinery_query);

        // Fetch rented worker details
        $worker_query = "SELECT w.name AS worker_name, u.username AS user_name, r.rental_date, r.rental_duration, r.notes 
                         FROM worker_rentals r 
                         JOIN users u ON r.user_id = u.id 
                         JOIN workers w ON r.worker_id = w.id";

        $worker_result = $conn->query($worker_query);

        echo "<h1>Rented Machinery</h1>";
        if ($machinery_result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Machinery Name</th>
                        <th>User Name</th>
                        <th>Rental Date</th>
                        <th>Return Date</th>
                        <th>Rental Price</th>
                        <th>Total Amount</th>
                    </tr>";
            while ($row = $machinery_result->fetch_assoc()) {
                $duration = (strtotime($row['return_date']) - strtotime($row['rental_date'])) / (60 * 60 * 24); // Calculate duration in days
                $total_amount = $duration * $row['rental_price'];
                echo "<tr>
                        <td>{$row['machinery_name']}</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['rental_date']}</td>
                        <td>{$row['return_date']}</td>
                        <td>\${$row['rental_price']}</td>
                        <td>\$$total_amount</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No rented machinery available.</p>";
        }

        echo "<h1>Rented Workers</h1>";
        if ($worker_result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Worker Name</th>
                        <th>User Name</th>
                        <th>Rental Date</th>
                        <th>Rental Duration (hours)</th>
                        <th>Notes</th>
                    </tr>";
            while ($row = $worker_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['worker_name']}</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['rental_date']}</td>
                        <td>{$row['rental_duration']}</td>
                        <td>{$row['notes']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No rented workers available.</p>";
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
</body>
</html>
