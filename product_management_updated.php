<?php
include 'db.php';
include 'header.php';
// Handle form submission to add a product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pid = $_POST['product_id']; // Assuming product_id is provided
    $name = $_POST['product_name'];
    $quantity = $_POST['product_quantity'];
    $price = $_POST['product_price'];
    $image = $_POST['product_image'];
    addProduct($pid, $name, $quantity, $price, $image);
    header("Location: ../html/admin.html"); // Redirect back to admin panel
    exit();
}

// Function to add a product
function addProduct($pid, $name, $quantity, $price, $image) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO products (pid, pname, pquantity, price, pimage) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdds", $pid, $name, $quantity, $price, $image);
    $stmt->execute();
    $stmt->close();
}

// Function to update product quantity
function updateProductQuantity($product_id, $quantity) {
    global $conn;
    $stmt = $conn->prepare("UPDATE products SET pquantity = pquantity - ? WHERE pid = ?");
    $stmt->bind_param("ii", $quantity, $product_id);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Product Management</title>
</head>
<body>
    <main>
        <h1>Product Management</h1>
        
        <form action="product_management_updated.php" method="POST">
            <label for="product_id">Product ID:</label>
            <input type="number" id="product_id" name="product_id" required><br>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required><br>

            <label for="product_quantity">Quantity:</label>
            <input type="number" id="product_quantity" name="product_quantity" required><br>

            <label for="product_price">Price:</label>
            <input type="text" id="product_price" name="product_price" required><br>

            <label for="product_image">Image:</label>
            <input type="text" id="product_image" name="product_image" required><br>

            <input type="submit" value="Add Product">
        </form>

        <h2>Existing Products</h2>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                $products = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($products as $product) {
                    echo "<tr>
                            <td>{$product['pid']}</td>
                            <td>{$product['pname']}</td>
                            <td>{$product['pquantity']}</td>
                            <td>{$product['price']}</td>
                            <td><img src='images/{$product['pimage']}' alt='{$product['pname']}' width='50'></td>
                          </tr>";
                }
                
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
</body>
</html>
