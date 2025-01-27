<?php
session_start();
include 'db.php';

// Display header
/*echo '<header>
        <h1>Login</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
      </header>';*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $a1 = $_POST['role'];
    $a2 = $_POST['username'];
    $a3 = $_POST['password'];
$a4 = $_POST['id'];
    if ($a1 == "user") {
        $sql = "SELECT * FROM users WHERE uname ='$a2' AND upass='$a3' AND uid='$a4'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['uid'] = $a4; // Store user ID in session
            $_SESSION['uname'] = $a2; // Store role in session
            $_SESSION['role'] = 'user'; // Store role in session
            header("Location: user.php");
            exit();
        } else {
            echo "login failed";
        }
    } elseif ($a1 == "farmer") {
        $sql = "SELECT * FROM farmers WHERE FNAME='$a2' AND password='$a3' AND fid='$a4'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['fid'] = $a4; // Store user ID in session
            $_SESSION['role'] = 'farmer'; // Store role in session
            header("Location: farmer.php");
            exit();
        } else {
            echo "login failed";
        }
    } elseif ($a1 == "worker") {
        $sql = "SELECT * FROM workers WHERE name='$a2' AND password='$a3'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['id'] = $a2; // Store user ID in session
            $_SESSION['role'] = 'worker'; // Store role in session
            header("Location: worker.php");
            exit();
        } else {
            echo "login failed";
        }
    } elseif ($a1 == "admin") {
        $sql = "SELECT * FROM login WHERE aname='$a2' AND apass='$a3'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['user_id'] = $a2; // Store user ID in session
            $_SESSION['role'] = 'admin'; // Store role in session
            header("Location: admin.php");
            exit();
        } else {
            echo "login failed";
        }
    }
}

if (isset($_SESSION['id'])) {
    echo "Logged in as worker: " . htmlspecialchars($_SESSION['user_id']);
} else {
    echo "Not logged in";
}
if (isset($_SESSION['uid'])) {
    echo "Logged in as user: " . htmlspecialchars($_SESSION['uid']);
} else {
    echo "Not logged in";
}
if (isset($_SESSION['fid'])) {
    echo "Logged in as farmer: " . htmlspecialchars($_SESSION['fid']);
} else {
    echo "Not logged in";
}

?>
