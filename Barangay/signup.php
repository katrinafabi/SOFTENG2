<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup1.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>Sign Up</title>
</head>
<body>
    <div id="navbar">
        <button id="sidebar-toggle" class="sidebar-button">&#9776;</button>
        <div id="navbarlogo">
            <img src="css/pictures/Logo/brgylogo.svg" alt="none.png">
            <h1>Barangay 433 Zone 44</h1>
        </div>
        <a href="signup.php" class="signupbtn">SIGN UP</a>
        <a href="login.php">LOGIN</a>
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
            <div id="sidebartopwimg" class="sidebartopwimg">
                <img src="css/pictures/sidebar/login.svg" alt="login">
                <span>Login</span>    
            </div>
        </a>
        <a href="signup.php" class="signupbtn">
            <div id="sidebartopwimg" class="sidebartopwimg active">
                <img src="css/pictures/sidebar/signupactive.svg" alt="signup">
                <span>Signup</span>    
            </div>
        </a>
    </div>

    <section>
        <div id="aboutsection">
            <form id="signup-form" action="phpexecution/register.php" method="POST">
                <h2>SIGN UP</h2>
                <p>Register to keep in touch!</p>
    
                <div id="labels" style="background-color: rgb(9, 165, 90);">
                    <h1>PERSONAL INFORMATION</h1>
                </div>
        
                <div id="inp1">
                    <div id="inp1label">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last name" required pattern="[A-Za-z\s]{2,}" title="Please enter at least 3 alphabetic characters">
                    </div>
        
                    <div id="inp1label">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First name" required pattern="[A-Za-z\s]{3,}" title="Please enter at least 3 alphabetic characters">
                    </div>
                    
                    <div id="inp1label">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name" required pattern="[A-Za-z\s]{3,}" title="Please enter at least 3 alphabetic characters">
                    </div>
        
                    <div id="inp23label">
                    <label for="suffix">Suffix</label>
                    <select id="suffix" name="suffix">
                        <option value="" disabled selected></option>
                        <option value="Sr">Senior</option>
                        <option value="Jr">Junior</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                    </select>
                </div>
                </div>
        
                <div id="inp1">
                    <div id="inp1label">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required pattern="/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/">
                    </div>

                    <div id="inp23label">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" readonly required>
                    </div>
        
                    <div id="inp1label">
                        <label for="birthplace">Birth Place</label>
                        <input type="text" id="birthplace" name="birthplace" placeholder="Enter your birth place" required pattern="[A-Za-z\s]{3,}" title="Please enter at least 3 alphabetic characters">

                    </div>
                </div>

                <div id="inp1">
                    <div id="inp2xlabel">
                        <label for="gender">Sex</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected>Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
        
                    <div id="inp1label">
                        <label for="civil">Civil Status</label>
                        <select id="civil" name="civil" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
        
                    <div id="inp1label">
                        <label for="religion">Religion</label>
                        <input type="text" id="religion" name="religion" placeholder="Religion" required required pattern="[A-Za-z\s]{4,}" title="Please enter at least 3 alphabetic characters">
                    </div>
                </div>

                <div id="labels" style="background-color: rgb(10, 186, 145);">
                    <h1>ADDRESS</h1>
                </div>
        
                <div id="inp1">
                    <div id="inp2label">
                        <label for="address1">Residence Address</label>
                        <input type="text" id="address1" name="address1" placeholder="Street number/Barangay" required required pattern="[A-Za-z\s]{8,}" title="Please enter at least 8 alphabetic characters">
                    </div>
        
                    <div id="inp1label">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="City" required required pattern="[A-Za-z\s]{4,}" title="Please enter at least 4 alphabetic characters">
                    </div>
        
                    <div id="inp2xlabel">
                        <label for="zip">Zip/Postal Code</label>
                        <input type="text" id="zip" name="zip" placeholder="Zip/Postal Code" required required pattern="[0-9]{4,}" title="Please enter a valid zip/postal code">
                    </div>
                </div>
        
                <div id="inp1">
                    <div id="inp1label">
                        <label for="citezenship">Citezenship</label>
                        <input type="text" id="citezenship" name="citezenship" placeholder="Citezenship" required pattern="[A-Za-z\s]{4,}" title="Please enter at least 4 alphabetic characters">
                    </div>
                        
                    <div id="inp1label">
                        <label for="number">Contact No.</label>
                        <input type="number" id="number" name="number" placeholder="09XX-XXXX-XXX" required pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number">
                    </div>
        
                    <div id="inp1label">
                        <label for="telephone">Telephone No. (Optional)</label>
                        <input type="telephone" id="telephone" name="telephone" placeholder="Enter your telephone number" pattern="[0-9]{3}-[0-9]{4}" title="Please enter a valid telephone number in the format XXX-XXXX">
                    </div>
                </div>
    
                <div id="labels" style = "background-color: rgb(9, 165, 90);">
                    <h1>ACCOUNT INFORMATION</h1>
                </div>
        
                <div id="inp1">
                    <div id="inp1label">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@gmail.com" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address">
                    </div>
        
                    <div id="inp1label">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required pattern="[A-Za-z\s]{4,}" title="Please enter at least 4 alphabetic characters">
                    </div>
                </div>
        
                <div id="inp1">
                    <div id="inp1label">
                        <label for="password">Password</label>
                            <div class="password-container">
                                <input type="password" id="password" name="password" placeholder="Enter your password" style="padding-right: 36px;" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Password must contain at least 8 characters, including at least one number, one uppercase letter, one lowercase letter, and one special character">
                                <img src="css/pictures/login/pass.svg" alt="Show Password" class="password-toggle" onclick="togglePassword()">
                            </div>
                    </div>
        
                    <div id="inp1label">
                        <label for="cmpassword">Confrim Password</label>
                            <div class="password-container">
                                <input type="password" id="cmpassword" name="cmpassword" placeholder="Enter your password" style="padding-right: 36px;" required>
                                <img src="css/pictures/login/pass.svg" alt="Show Password" class="cmpassword-toggle" onclick="togglecmPassword()">
                            </div>
                    </div>
                </div>
                    
                <button class="button">Sign Up</button>
                <p>Already have an account? <a href="login.php" style="text-decoration: none;">Login</a></p>
            </form>
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

        function togglecmPassword() {
            var cmpasswordInput = document.getElementById("cmpassword");
            var cmpasswordToggle = document.querySelector(".cmpassword-toggle");

            if (cmpasswordInput.type === "password") {
                cmpasswordInput.type = "text";
                cmpasswordToggle.src = "css/pictures/login/showpass.svg";
            } else {
                cmpasswordInput.type = "password";
                cmpasswordToggle.src = "css/pictures/login/pass.svg";
            }
        }
        
        // Function to calculate age from date of birth
        function calculateAge(dob) {
            var birthDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDifference = today.getMonth() - birthDate.getMonth();
        
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
        
            return age;
        }
        
        document.getElementById('dob').addEventListener('change', function() {
            var dob = this.value;
            if (!isValidDate(dob)) {
                alert("Please enter a valid date of birth.");
                this.value = ""; // Clear the invalid input
                document.getElementById('age').value = ""; // Clear the age input
            } else if (isFutureDate(dob)) {
                alert("Please enter a date of birth before the current date.");
                this.value = ""; // Clear the invalid input
                document.getElementById('age').value = ""; // Clear the age input
            } else {
                var age = calculateAge(dob);
                document.getElementById('age').value = age;
            }
        });
        
        // Function to validate date format
        function isValidDate(dateString) {
            var regEx = /^\d{4}-\d{2}-\d{2}$/;
            if (!dateString.match(regEx)) return false;  // Invalid format
            var d = new Date(dateString);
            var dNum = d.getTime();
            if (!dNum && dNum !== 0) return false; // NaN value, invalid date
            return d.toISOString().slice(0, 10) === dateString;
        }
        
        // Function to check if date is in the future
        function isFutureDate(dateString) {
            var inputDate = new Date(dateString);
            var currentDate = new Date();
            return inputDate > currentDate;
        }
        
        // Set maximum date to 150 years ago
        var today = new Date();
        var minDate = new Date(today.getFullYear() - 150, today.getMonth(), today.getDate());
        var maxDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());
        document.getElementById('dob').min = minDate.toISOString().split('T')[0];
        document.getElementById('dob').max = maxDate.toISOString().split('T')[0];

        
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
                    window.location.href = 'login.php';
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
