<?php

require_once('phpexecution/checklogin.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="server-css/server-login.css">
    <link rel="icon" type="image/x-icon" href="server-css/pictures/Logo/brgylogo.svg">
    <title>Server-Login</title>
</head>
<body>
    <div id="navbar">
        <div id="navbarlogo">
            <img src="server-css/pictures/Logo/brgylogo.svg" alt="none.png">
            <h1>Barangay 433 Zone 44</h1>
        </div>
    </div>
    <section id="for100vh">
        <div id="aboutsection">
        <form id="login-form" action="phpexecution/loginquery.php" method="POST">
            <img src="server-css/pictures/Logo/brgylogo.svg" alt="">
            <h2>Admin Login</h2>
            <p>Welcome Back, Admin</p>

            <div id="inp1">
                <div id="inp1label">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
            </div>

            <div id="inp1">
                <div id="inp1label">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>
                <button>Login</button>
        </form>
        </div>
    </section>
    <script>
        $(document).ready(function() {
        $('#login-form').submit(function(event) {
            // Prevent default form submission
            event.preventDefault();
    
            // Serialize form data
            var formData = $(this).serialize();
    
            // Send form data to the server
            $.ajax({
                type: 'POST',
                url: 'phpexecution/loginquery.php',
                data: formData,
                success: function(response) {
                    // Handle server response
                    alert('Login ' + response);
                    if (response.trim() === 'Successful') { // Ensure that 'Success' is returned exactly
                        // Redirect to the dashboard or any other page
                        window.location.href = 'https://barangay-433-zone-44.000webhostapp.com/Server/server-dashboard.php';
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>
</body>
</html>