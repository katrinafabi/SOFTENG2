<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>Login</title>
</head>
<body>
    <div id="navbar">
    <button id="sidebar-toggle" class="sidebar-button">&#9776;</button>
        <div id="navbarlogo">
            <img src="css/pictures/Logo/brgylogo.svg" alt="none.png">
            <h1>Barangay 433 Zone 44</h1>
        </div>
        <a href="signup.php" class="signupbtn">SIGN UP</a>
        <a class="active" href="login.php">LOGIN</a>
        <a href="index.html">HOME</a>
        <a href="aboutus.html">ABOUT</a>
        <a href="contact.html">CONTACT</a>
    </div>

    <div id="sidebar">
        <div id="sidebarlogo">
            <img src="css/pictures/Logo/brgylogo.svg" alt="none.png">
            <h1>DocQuest</h1>
            <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
        </div>

        <a href="index.html">
            <div id="sidebartopwimg" class="sidebartopwimg">
                <img src="css/pictures/sidebar/home.svg" alt="home">
                <span>Home</span>    
            </div>
        </a>
        <a href="aboutus.html">
            <div id="sidebartopwimg" class="sidebartopwimg">
                <img src="css/pictures/sidebar/about.svg" alt="aboutus">
                <span>About</span>    
            </div>
        </a>

        <a href="contact.html" class="active">
            <div id="sidebartopwimg" class="sidebartopwimg">
                <img src="css/pictures/sidebar/contacts.svg" alt="contact">
                <span>Contact us</span> 
            </div>
        </a>

        <a href="login.php">
            <div id="sidebartopwimg" class="sidebartopwimg active">
                <img src="css/pictures/sidebar/loginactive.svg" alt="login">
                <span>Login</span>    
            </div>
        </a>
        <a href="signup.php" class="signupbtn">
            <div id="sidebartopwimg" class="sidebartopwimg">
                <img src="css/pictures/sidebar/signup.svg" alt="signup">
                <span>Signup</span>    
            </div>
        </a>
    </div>

    <section>
        <div id="aboutsection">
            <div id="containerform">
                <div id="pictureform">
                    <img src="css/pictures/login/loginimg.svg" alt="loginimg">
                </div>
                <div id="formbox">
                    <form id="login-form" action="phpexecution/loginquery.php" method="POST">
                        <h1>Hey,</h1>
                        <h6>Welcome back, We missed you!</h6>
            
                        <div id="inp1">
                            <div id="inp1label">
                                <label for="username">Username or Email</label>
                                <input type="text" id="username" name="username" placeholder="Email or Username" required>
                            </div>
                        </div>
            
                        <div id="inp1">
                            <div id="inp1label">
                                <label for="password">Password</label>
                                <div class="password-container">
                                    <input type="password" id="password" name="password" placeholder="Enter your password" style="padding-right: 32px;" required>
                                    <img src="css/pictures/login/pass.svg" alt="Show Password" class="password-toggle" onclick="togglePassword()">
                                </div>
                            </div>
                        </div>
            
                        <div id="fgpw">
                            <a href="forgotpw.html">Forgot Password?</a>
                        </div>
                        <button class="button">Login</button>
                        <p style="font-size: 11.5px;">Don't have an account? <a href="signup.php" style="text-decoration: none;">Sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Function to toggle password visibility
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var passwordToggle = document.querySelector(".password-toggle");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.src = "css/pictures/login/showpass.svg";
            } else {
                passwordInput.type = "password";
                passwordToggle.src = "css/pictures/login/pass.svg";
            }
        }
        
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
                        window.location.href = 'dashboard.php';
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function openSidebar() {
            document.getElementById("sidebar").style.width = "250px";
        }

        function closeSidebar() {
            document.getElementById("sidebar").style.width = "0";
        }

        // Toggle sidebar when sidebar-toggle button is clicked
        document.getElementById("sidebar-toggle").addEventListener("click", openSidebar);
    </script>
</body>
</html>