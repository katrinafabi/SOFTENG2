<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="server-css/server-add-admin1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="server-css/pictures/Logo/brgylogo.svg">
    <title>Server-New Admin</title>
</head>
<body>

    <div class="sidebar">
        <div id="sidebartopa">
            <a href="server-dashboard.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg1')">
                    <img src="server-css/pictures/sidebar/home.svg" alt="home">
                    <span>Home</span>    
                </div>
            </a>
            
            <a href="report.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg1')">
                    <img src="server-css/pictures/sidebar/bar_chart.svg" alt="home">
                    <span>Report</span>    
                </div>
            </a>

            <a href="server-profile.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg3')">
                    <img src="server-css/pictures/sidebar/profile.svg" alt="Profile">
                    <span>Profile</span>   
                </div>
            </a>

            <a href="server-add-admin.php">
                <div id="sidebartopwimg" class="sidebartopwimg active" onclick="toggleActive('sidebartopwimg3')">
                    <img src="server-css/pictures/sidebar/addminactive.svg" alt="Profile">
                    <span>New Admin</span>   
                </div>
            </a>
        </div>
        
        <div id="sidebarbottoma">
            <a href="phpexecution/endsession.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg4')">
                    <img src="server-css/pictures/sidebar/logout.svg" alt="Logout">
                    <span>Logout</span>  
                </div>
            </a>
        </div>

        <hr>

        <div id="profilebox">
            <div id="profileimage"></div>

            <div id="namebox">
                <h5 id="firstname"><?php echo ucfirst($user['username']);?></h5>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            var firstname = $('#firstname').text();
            var intials = firstname.charAt(0).toUpperCase();;
            $('#profileimage').text(intials);
        });
    </script>

    <section id="for100vh">
        <div id="aboutsection">
            <h1>ADD ADMIN</h1>
            <p>Create a new Admin account</p>  
            <form id="signup-form" action="phpexecution/register.php" method="POST">   
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

                <div id="inp1">
                    <div id="inp1label">
                        <label for="cmpassword">Confirm Password</label>
                        <input type="password" id="cmpassword" name="cmpassword" placeholder="Enter your password" required>
                    </div>
                </div>
                <button>Create</button>
        </form>
        </div>
    </section>
    <script>
    $(document).ready(function() {
        $('#signup-form').submit(function(event) {
            // Prevent default form submission
            event.preventDefault();
    
            // Serialize form data
            var formData = $(this).serialize();
    
            // Send form data to the server
            $.ajax({
                type: 'POST',
                url: 'phpexecution/register.php',
                data: formData,
                success: function(response) {
                    // Handle server response
                    alert('Registration ' + response);
                    if (response.trim() === 'Successful') { // Ensure that 'Success' is returned exactly
                        // Redirect to the dashboard or any other page
                        window.location.href = 'server-add-admin.php';
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