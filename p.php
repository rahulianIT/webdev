<?php
\*
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "shetkari_raja"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getProduct() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Products</title>
</head>
<body>

    <section class="products">
        <h1>Products</h1>

        <div class="product-container">
            <?php
            $products = getProduct();
            foreach ($products as $product) {
                echo "<div class='product'>
                        <img src='images/{$product['pimage']}' alt='{$product['pname']}'>
                        <h3>{$product['pname']}</h3>
                        <p>Price: {$product['price']}</p>
                        <p>Quantity: {$product['pquantity']}</p>
                        <form method='POST' action='cart.php'>
                            <input type='hidden' name='pid' value='{$product['pid']}'>
                            <button type='submit' name='add_to_cart' class='add-to-cart'>Add to Cart</button>
                        </form>
                        <a href='purchase.php?product_id={$product['pid']}' class='buy-now'>Buy Now</a>
                      </div>";
            }
            ?>
        </div>
    </section>

    <style>
        .product-container {
            display: grid;
            grid-template-columns: repeat(3, 175%);
            gap: 20px;
            padding: 20px;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .products {
            padding: 20px;
        }

        .product {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product img {
            max-width: 100%;
            border-radius: 10px;
        }

        .product:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .product h3 {
            margin: 10px 0;
        }

        .product p {
            margin: 5px 0;
        }

        .product button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 5px;
        }

        .product button:hover {
            background-color: #218838;
        }

        .buy-now {
            background-color: #007bff;
        }

        .buy-now:hover {
            background-color: #0056b3;
        }
    </style>
    

</body>
</html>
*/?>