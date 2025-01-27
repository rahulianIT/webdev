<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:login.html");
    exit();
}

// Include database connection
include 'db.php';
include 'header.php';
// Get product ID from query string
$product_id = $_GET['product_id'];

// Fetch product details
$product = getProductById($product_id);

// Handle Add to Cart
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $product_id;
    echo "<script>alert('Product added to cart!');</script>";
}

// Handle Buy Now
if (isset($_POST['buy_now'])) {
    header("Location: purchase.php?product_id=" . $product_id);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Product Details</title>
</head>
<body>
    <main>
        <h1><?php echo $product['name']; ?></h1>
        <p>Description: <?php echo $product['description']; ?></p>
        <p>Price: $<?php echo $product['price']; ?></p>
        <img src="<?php echo $product['mimage']; ?>" alt="<?php echo $product['name']; ?>" width="200">
        <form method="post">
            <button type="submit" name="add_to_cart">Add to Cart</button>
            <button type="submit" name="buy_now">Buy Now</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
</body>
</html>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
