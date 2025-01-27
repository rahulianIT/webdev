<?php
session_start();
session_destroy(); // Destroy all session data
header("Location: index.php"); // Redirect to login page
exit();
?>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
