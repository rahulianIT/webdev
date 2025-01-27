<?php
include 'db.php';
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $a=$_POST['availability'];
    $photo = $_POST['photo']; // Assuming a photo upload is handled elsewhere

    // Insert the new worker into the database
    $stmt = $conn->prepare("INSERT INTO workers (name, password, email, CONTACT,availability,PHOTO) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssss", $username, $hashed_password, $email, $phone,$a,$photo);

    if ($stmt->execute()) {
        echo "Worker registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Worker</title>
</head>
<body>
    <h2>Register Worker</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        <label for="availability">Availability:</label>
        <input type="checkbox" id="availability" name="availability" required>
        <label for="photo">Photo:</label>
        <input type="text" id="photo" name="photo"><br><br> <!-- Assuming a text input for photo path -->
        <input type="submit" value="Register">
    </form>
</body>
</html>
