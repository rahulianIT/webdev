<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Welcome</title>
</head>
<body>
    <main>
        <h2>Welcome to Shetkari Raja</h2>
        <form action="login.php" method="POST">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" required>
            <br>
            <label for="role">Role ID</label>
            <input type="text" id="role" name="id" required>
            <br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit" class="dashboard-button">Login</button>
        </form>
        add section for registration to every role with link and name
    <section>
        <h3>Register</h3>
        <ul>
        <li><a href="register_farmer.php">Register as Farmer</a></li>
        <li><a href="register_trader.php">Register as Trader</a></li>
        <li><a href="register_supplier.php">Register as Supplier</a></li>
        <li><a href="register_buyer.php">Register as Buyer</a></li>
        </ul>
    </section>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
        <div>
            <a href="https://facebook.com" target="_blank">Facebook</a>
            <a href="https://twitter.com" target="_blank">Twitter</a>
            <a href="https://instagram.com" target="_blank">Instagram</a>
        </div>
    </footer>
</body>
</html>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
