<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Purchase Confirmation</title>
</head>  
     <a href="index.php">Home</a>
     <a href="product.php">Products</a>
     <a href="cart.php">Cart</a>
    <a href="purchase.php">Purchase</a>
     <a href="logout.php">Logout</a>
    <h1>Purchase Confirmation</h1>
    <p>Your order has been successfully placed.</p>
    <p>Order Details:</p>
    <div id="order_details">
        <b>Product Name:</b> <?php echo $_SESSION['product_name']; ?>
         <b>Quantity:</b> <?php echo $_SESSION['product_quantity']; ?>
         <b>Price:</b> $<?php echo $_SESSION['product_price']; ?>
    </div>
    <?php
    $total_amount = 0;
    $order_details = [];
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
        }
        ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
            <?php
            foreach ($_SESSION['cart'] as $item) {
                ?>
                <tr>
                    \begin{code}
                    <td><?php echo $item['name']; ?></td>
                    <td>$<?php echo $item['price'] * $item['quantity']; ?></td>
                    \end{code}
                </tr>
                <?php
            }
            ?>
        </table>
        <h2>Total Amount: $<?php echo $total_amount; ?></h2>
        <?php
        $_SESSION['cart'] = [];
        ?>
        </div>
    </main>
</body>
</html>
