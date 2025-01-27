<?php 
include 'header.php'; 
include 'session_tracker.php'; 

// Log session activity
logSessionActivity('Accessed Worker Dashboard');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/icons.css">
    <title>Worker Dashboard</title>
</head>
<body>
    <main>
        <h1>Worker Dashboard</h1>

        <h2><img src="images/request_icon.png" class="icon" alt="Request Icon">Work Requests</h2>
        <table>
            <thead>
                <tr>
                    <th>Farmer ID</th>
                    <th>Work Description</th>
                    <th>Date Posted</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $work_requests = getWorkRequests(); // Function to fetch work requests
                foreach ($work_requests as $request) {
                    echo "<tr>
                            <td>{$request['farmer_id']}</td>
                            <td>{$request['description']}</td>
                            <td>{$request['date_posted']}</td>
                            <td>{$request['status']}</td>
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

<!-- Footer Start -->
<?php include 'footer.php'; ?>
