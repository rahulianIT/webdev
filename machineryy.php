<?php
include 'db.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Machinery List</title>
    <style>
        #machinery-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .machinery-item {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .machinery-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Available Machinery</h1>
    </header>
    <main>
        <div id="machinery-list">
            <?php
            // Fetch machinery data from the database
            $result = $conn->query("SELECT id, name, mimage, rental_price FROM machinery");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='machinery-item'>
                            <h2>{$row['name']}</h2>
                            <img src='images/{$row['mimage']}' alt='{$row['name']}'>
                            <p>Price: \${$row['rental_price']}</p>
                            <button onclick=\"location.href='rent_machinery.php?machinery_id={$row['id']}'\">Rent</button>
                            <button onclick=\"buyMachinery('{$row['name']}')\">Buy</button>
                          </div>";
                }
            } else {
                echo "<p>No machinery available.</p>";
            }
            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
</body>
</html>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
