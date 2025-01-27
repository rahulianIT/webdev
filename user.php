<?php

include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>User Dashboard</title>
    <style>
        .button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .result {
            display: none; /* Hide results initially */
        }
        .profile-pic {
            width: 100px; /* Set width */
            height: 100px; /* Set height */
            border-radius: 50%; /* Make it circular */
        }
    </style>
    <script>
        function showResult(section) {
            // Hide all results
            var results = document.querySelectorAll('.result');
            results.forEach(function(result) {
                result.style.display = 'none';
            });
            // Show the selected result
            document.getElementById(section).style.display = 'block';
        }
    </script>
</head>
<body>
    <main>
        <h2>User Dashboard</h2>
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['uname']); ?></h3>
        <?php if (isset($_SESSION['uphoto'])): ?>
            <img src="<?php echo htmlspecialchars($_SESSION['uphoto']); ?>" alt="Profile Picture" class="profile-pic">
        <?php endif; ?>
        
        <button class="button" onclick="showResult('viewProducts')">View Products</button>
        <button class="button" onclick="showResult('orderHistory')">Order History</button>
        
        <div id="viewProducts" class="result">
            <h3>Browse Products</h3>
            <div id="product_list">
                <?php include 'products.php'; ?>
            </div>
        </div>

        <div id="orderHistory" class="result">
            <h3>Your Order History</h3>
            <!-- Logic to display user's order history will go here -->
            <?php include 'order.php'; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
</body>
</html>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
