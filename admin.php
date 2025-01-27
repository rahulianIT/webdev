<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Admin Dashboard</title>
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
    <header>
        <div class="container-fluid bg-primary py-5 bg-hero mb-5">
            <div class="container py-5">
                <div class="row justify-content-start">
                    <div class="col-lg-8 text-center text-lg-start">
                        <h1 class="display-1 text-white mb-md-4">Admin Dashboard</h1>
                        <button class="button" onclick="showResult('farmers')">View Farmers</button>
                        <button class="button" onclick="showResult('machinery')">View Machinery</button>
                        <button class="button" onclick="showResult('workers')">View Workers</button>
                        <button class="button" onclick="showResult('products')">View Products</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="farmers" class="result">
            <h3>Farmers</h3>
            <table>
                <thead>
                    <tr>
                        <th>Farmer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>City</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $farmers = getFarmers();
                    foreach ($farmers as $farmer) {
                        echo "<tr>
                                <td>{$farmer['fid']}</td>
                                <td>{$farmer['FNAME']}</td>
                                <td>{$farmer['EMAIL']}</td>
                                <td>{$farmer['CONTACT']}</td>
                                <td>{$farmer['FCITY']}</td>
                                <td><img src='images/{$farmer['PHOTO']}' alt='{$farmer['FNAME']}' height='200px' width='200px'></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="machinery" class="result">
            <h3>Machinery</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Rental Price</th>
                        <th>Availability</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $machinery = getMachinery();
                    foreach ($machinery as $item) {
                        echo "<tr>
                                <td>{$item['id']}</td>
                                <td>{$item['name']}</td>
                                <td>{$item['description']}</td>
                                <td>{$item['rental_price']}</td>
                                <td>" . ($item['availability'] ? 'Available' : 'Not Available') . "</td>
                                <td><img src='images/{$item['mimage']}' alt='{$item['name']}' height='200px' width='200px'></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="workers" class="result">
            <h3>Workers</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $workers = getWorkers();
                    foreach ($workers as $worker) {
                        echo "<tr>
                                <td>{$worker['id']}</td>
                                <td>{$worker['name']}</td>
                                <td>{$worker['email']}</td>
                                <td>{$worker['CONTACT']}</td>
                                <td><img src='images/{$worker['PHOTO']}' alt='{$worker['name']}' height='200px' width='200px'></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="products" class="result">
            <h3>Products</h3>
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
                    $products = getProducts();
                    foreach ($products as $product) {
                        echo "<tr>
                                <td>{$product['pid']}</td>
                                <td>{$product['pname']}</td>
                                <td>{$product['pquantity']}</td>
                                <td>{$product['price']}</td>
                                <td><img src='images/{$product['pimage']}' alt='{$product['pname']}' height='200px' width='200px'></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
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
```

<!-- Footer Start -->
<?php include 'footer.php'; ?>
