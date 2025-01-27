<?php
include 'db.php';
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $photo = $_POST['photo']; // Assuming a photo upload is handled elsewhere

    $stmt = $conn->prepare("INSERT INTO `farmers` (FNAME, password, EMAIL, CONTACT, FCITY, PHOTO) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $password, $email, $phone, $city, $photo);

    if ($stmt->execute()) {
        echo "Farmer registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Farmer</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/style2.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2980b9;
        }
        .btn-primary {
            background-color: #2980b9;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1a5276;
        }
        .form-group label {
            font-weight: bold;
        }
        .input-group-text {
            background-color: #2980b9;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register Farmer</h2>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="username">Username:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-envelope"></i></span>
                    </div>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-phone"></i></span>
                    </div>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-map-marker"></i></span>
                    </div>
                    <input type="text" id="city" name="city" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="text" id="photo" name="photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
    <?php include 'footer.php'; ?>
</body>
</html>
