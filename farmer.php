<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/icons.css">
    <title>Farmer Dashboard</title>
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
                        <h1 class="display-1 text-white mb-md-4">Farmer Dashboard</h1>
                        <p class="lead text-white mb-4">Welcome to the Farmer Dashboard. Here you can manage your products, machinery, workers, and work requests.</p>
                        <button class="button" onclick="showResult('removeProduct')">Manage Product</button>
                        <button class="button" onclick="showResult('viewMachinery')">View Machinery</button>
                        <button class="button" onclick="showResult('rentWorker')">Rent a Worker</button>
                        <button class="button" onclick="showResult('postWorkRequest')">Post Work Request</button>
                       a
                    <button class="button" onclick="logout()">Logout</button>
                    <script>
                        function logout() {
                            // Destroy the session and redirect to index.php
                            fetch('logout.php')
                                .then(response => {
                                    if (response.ok) {
                                        window.location.href = 'index.php';
                                    }
                                });
                        }
                    </script>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
       
        <div id="removeProduct" class="result">
            <?php
            include 'pm.php';
            ?>
        </div>

        <div id="viewMachinery" class="result">
            <h2>Machinery</h2>
            <button onclick="location.href='machineryy.php'" class="button-icon">View Machinery</button>
        </div>

        <div id="rentWorker" class="result">
            <h2>Rent Workers</h2>
            <button onclick="location.href='rent.php'" class="button-icon">Rent a Worker</button>
        </div>

        <div id="postWorkRequest" class="result">
            <h2>Post Work Request</h2>
            <form action="post_work_request.php" method="POST" onsubmit="showAlert('Work request posted successfully!');">
                <label for="work_description">Work Description:</label>
                <textarea id="work_description" name="work_description" required></textarea><br>
                <input type="submit" value="Post Work Request" class="button-icon">
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Shetkari Raja</p>
    </footer>
</body>
</html>

<!-- Footer Start -->
<?php include 'footer.php'; ?>
