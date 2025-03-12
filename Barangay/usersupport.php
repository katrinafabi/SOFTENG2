<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usersupport.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>User Support</title>
</head>
<body>
    <div class="sidebar">
        <div id="sidebartopa">
            <a href="dashboard.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg1')">
                    <img src="css/pictures/sidebar/home.svg" alt="home">
                    <span>Home</span>    
                </div>
            </a>

            <a href="filerequest.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="css/pictures/sidebar/file.svg" alt="File">
                    <span>File Request</span>
                </div>
            </a>

            <a href="profileuser.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg3')">
                    <img src="css/pictures/sidebar/profile.svg" alt="Profile">
                    <span>Profile</span>   
                </div>
            </a>

            <a href="phpexecution/endsession.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg4')">
                    <img src="css/pictures/sidebar/logout.svg" alt="Logout">
                    <span>Logout</span>  
                </div>
            </a>
        </div>
        
        <div id="sidebarbottoma">
            <a href="usersupport.php">
                <div id="sidebartopwimg" class="sidebartopwimg active" onclick="toggleActive('sidebartopwimg4')">
                    <img src="css/pictures/sidebar/supportactive.svg" alt="Support">
                    <span>Support</span>  
                </div>
            </a>
        </div>

        <hr>

        <div id="profilebox">
            <div id="profileimage"></div>

            <div id="namebox">
                <h5 id="firstname"><?php echo $user['last_name'] . ', ' . substr($user['first_name'], 0, 1).'.';?></h5>
                <p><?php echo $user['email'];?></p>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            var firstname = $('#firstname').text();
            var intials = firstname.charAt(0);
            $('#profileimage').text(intials);
        });
    </script>

    <section id="for100vh">
        <div id="middlebox">
            <h1>USER SUPPORT</h1>
            <p>Any question you want to ask?, Do it here!</p>
            <form id="login-form" action="phpexecution/sendmail.php" method="POST">
                <div id="inp1">
                    <div id="inp1label">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo $user['email'];?>" required>
                    </div>
    
                    <div id="inp1label">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" value="<?php echo $user['first_name'] . ' ' . $user['last_name'];?>" required>
                    </div>
                </div>
                <div id="inp1">
                    <div id="inp1label">
                        <label for="mess">Message</label>
                        <textarea id="mess" name="mess" placeholder="Enter your message..."></textarea>
                    </div>
                </div>
                <button>Send</button>
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
                url: 'phpexecution/sendmail.php',
                data: formData,
                success: function(response) {
                    // Handle server response
                    alert('Email ' + response);
                    if (response.trim() === 'Successful') { // Ensure that 'Success' is returned exactly
                        // Redirect to the dashboard or any other page
                        window.location.href = 'https://barangay-433-zone-44.000webhostapp.com/Barangay/usersupport.php';
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