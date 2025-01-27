<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conn = mysqli_connect("localhost", "root", "", "shetkari_raja");

    if ($role == "user") {
        $sql = "SELECT * FROM users WHERE uname ='$username' AND upass='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $username;
            $_SESSION['profile_picture'] = $user['profile_picture']; // Assuming 'profile_picture' is the column name
            header("Location: user.php");
            exit();
        } else {
            echo "login failed";
        }
    } elseif ($role == "farmer") {
        $sql = "SELECT * FROM farmers WHERE FNAME='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $farmer = mysqli_fetch_assoc($result);
            $_SESSION['farmer'] = $username;
            $_SESSION['profile_picture'] = $farmer['profile_picture']; // Assuming 'profile_picture' is the column name
            header("Location: farmer.html");
            exit();
        } else {
            echo "login failed";
        }
    } elseif ($role == "worker") {
        $sql = "SELECT * FROM workers WHERE name='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['worker'] = $username;
            header("Location: worker.html");
            exit();
        } else {
            echo "login failed";
        }
    } elseif ($role == "admin") {
        $sql = "SELECT * FROM login WHERE aname='$username' AND apass='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['admin'] = $username;
            header("Location: admin.html");
            exit();
        } else {
            echo "login failed";
        }
    }
}

if (isset($_SESSION['user'])) {
    echo "Logged in as user: " . $_SESSION['user'];
} elseif (isset($_SESSION['farmer'])) {
    echo "Logged in as farmer: " . $_SESSION['farmer'];
} elseif (isset($_SESSION['worker'])) {
    echo "Logged in as worker: " . $_SESSION['worker'];
} elseif (isset($_SESSION['admin'])) {
    echo "Logged in as admin: " . $_SESSION['admin'];
} else {
    echo "Not logged in";
}
?>
