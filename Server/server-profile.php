<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="server-css/server-profilen.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="server-css/pictures/Logo/brgylogo.svg">
    <title>Server-Profile</title>
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
                <div id="sidebartopwimg" class="sidebartopwimg active" onclick="toggleActive('sidebartopwimg3')">
                    <img src="server-css/pictures/sidebar/profileactive.svg" alt="Profile">
                    <span>Profile</span>   
                </div>
            </a>

            <a href="server-add-admin.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg3')">
                    <img src="server-css/pictures/sidebar/addmin.svg" alt="Profile">
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

    <section id="for100vh">
        <div id="aboutsection">
            <h1>ADMIN PROFILE SETTINGS</h1>
            <p>Customize your account</p> 
            <form>    
                <div id="inp1">
                    <div id="inp1label">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" style="width:40%;" placeholder="Enter your username" value="<?php echo $user['username'];?>" required>
                    </div>
                </div>
                
                <!-- Button to open change password modal -->
                <button type="submit" >Save</button>
                <button id="change-password-button" type="button" style="margin-top:20px">Change Password</button>
            </form>
        </div>
    </section>

    <!-- Change Password Modal -->
    <div id="changePasswordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="change-password-form" action="phpexecution/change_password.php" method="POST">
                <h2>Change Password</h2>
                <div id="inp1">
                    <input type="hidden" id="username" name="username" style="width:40%;" placeholder="Enter your username" value="<?php echo $user['username'];?>" required>
                    <div id="inp1label">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Enter your current password" required>
                    </div>
                </div>
                <div id="inp1">
                    <div id="inp1label">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="Enter your new password" required>
                    </div>
                </div>
                <div id="inp1">
                    <div id="inp1label">
                        <label for="confirm_new_password">Confirm New Password</label>
                        <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm your new password" required>
                    </div>
                </div>
                <button type="submit">Update Password</button>
            </form>
        </div>
    </div>
    
    <script>
         $(document).ready(function(){
            var firstname = $('#firstname').text();
            var intials = firstname.charAt(0);
            $('#profileimage').text(intials);
        });
    
        // Get modal element
        var modal = document.getElementById("changePasswordModal");

        // Get open modal button
        var btn = document.getElementById("change-password-button");

        // Get close button
        var span = document.getElementsByClassName("close")[0];

        // Listen for close click
        span.addEventListener('click', function() {
            modal.style.display = "none";
        });

        // Listen for outside click
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        // Bind click event to open modal button
        $('#change-password-button').click(function() {
            $('#changePasswordModal').css('display', 'flex'); // Set display property using jQuery
        });
        
        $('#change-password-form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'phpexecution/update_admin_pass.php',
                data: formData,
                success: function(response) {
                    alert(response);
                    if (response.trim() === 'Successful') {
                         window.location.href = 'server-profile.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
    <style>
       #changePasswordModal{
            display:none;
            align-items: center; /* Center modal vertically */
            justify-content: center; /* Center modal horizontally */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4);
        }
        .modal {
            display: flex; /* Center modal */
            align-items: center; /* Center modal vertically */
            justify-content: center; /* Center modal horizontally */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 400px; /* Set modal width to 300px */
            box-shadow: 0 5px 15px rgba(0,0,0,.5);
            border-radius: 5px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .modal-content h2{
            margin-bottom:20px;
        }
        .modal-content button{
            width:100%;
        }
        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</body>
</html>