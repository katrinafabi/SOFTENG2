<?php
require_once('phpexecution/uniretrieve.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profileuser.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>Profile</title>
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
                <div id="sidebartopwimg" class="sidebartopwimg active" onclick="toggleActive('sidebartopwimg3')">
                    <img src="css/pictures/sidebar/profileactive.svg" alt="Profile">
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
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg4')">
                    <img src="css/pictures/sidebar/support.svg" alt="Support">
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

    <section id="for100vh">
        <div id="middlebox">
            <h1>PROFILE SETTINGS</h1>
            <p>Customize your profile</p>  
            <form id="login-form" action="phpexecution/updateprofile.php" method="POST">
                <div id="inp1">
                    <h1>PERSONAL INFORMATION</h1>
                </div>
    
                <div id="inp1">
                    <div id="inp1label">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last name" value="<?php echo $user['last_name'];?>" required>
                    </div>
    
                    <div id="inp1label">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First name" value="<?php echo $user['first_name'];?>" required>
                    </div>
                
                    <div id="inp1label">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php echo $user['mid_name'];?>" required>
                    </div>
    
                    <div id="inp23label">
                        <label for="suffix">Suffix</label>
                            <select id="suffix" name="suffix">
                                <option value="" disabled selected></option>
                                <option value="Sr"<?php if($user['suffix'] == 'Sr') echo ' selected'; ?>>Senior</option>
                                <option value="Jr"<?php if($user['suffix'] == 'Jr') echo ' selected'; ?>>Junior</option>
                                <option value="I"<?php if($user['suffix'] == 'I') echo ' selected'; ?>>I</option>
                                <option value="II"<?php if($user['suffix'] == 'II') echo ' selected'; ?>>II</option>
                                <option value="III"<?php if($user['suffix'] == 'III') echo ' selected'; ?>>III</option>
                                <option value="IV"<?php if($user['suffix'] == 'IV') echo ' selected'; ?>>IV</option>
                            </select>
                    </div>
                </div>
    
                <div id="inp1">
                    <div id="inp1label">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="<?php echo $user['birthdate'];?>" required>
                    </div>

                    <div id="inp23label">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" value="<?php echo $user['age'];?>" required>
                    </div>
    
                    <div id="inp1label">
                        <label for="birthplace">Birth Place</label>
                        <input type="text" id="birthplace" name="birthplace" placeholder="Enter your birth place" value="<?php echo $user['birthplace'];?>" required>
                    </div>
                </div>

                <div id="inp1">
                    <div id="inp23label">
                        <label for="gender">Sex</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled>Select Sex</option>
                            <option value="male"<?php if($user['sex'] == 'male') echo ' selected'; ?>>Male</option>
                            <option value="female"<?php if($user['sex'] == 'female') echo ' selected'; ?>>Female</option>
                            <option value="other"<?php if($user['sex'] == 'other') echo ' selected'; ?>>Other</option>
                        </select>
                    </div>
    
                    <div id="inp1label">
                        <label for="civil">Civil Status</label>
                        <select id="civil" name="civil" required>
                            <option value="" disabled>Select Status</option>
                            <option value="Single"<?php if($user['status'] == 'Single') echo ' selected'; ?>>Single</option>
                            <option value="Married"<?php if($user['status'] == 'Married') echo ' selected'; ?>>Married</option>
                            <option value="Widowed"<?php if($user['status'] == 'Widowed') echo ' selected'; ?>>Widowed</option>
                        </select>

                    </div>
    
                    <div id="inp1label">
                        <label for="religion">Religion</label>
                        <input type="text" id="religion" name="religion" placeholder="Religion" value="<?php echo $user['religion'];?>"  required>
                    </div>
                </div>

                <div id="inp1">
                    <h1>ADDRESS</h1>
                </div>

                <div id="inp1">
                    <div id="inp2label">
                        <label for="address1">Residence Address</label>
                        <input type="text" id="address1" name="address1" placeholder="Street number/Barangay" value="<?php echo $user['address'];?>"  required>
                    </div>
    
                    <div id="inp1label">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="City" value="<?php echo $user['city'];?>"  required>
                    </div>
    
                    <div id="inp2xlabel">
                        <label for="zip">Zip/Postal Code</label>
                        <input type="text" id="zip" name="zip" placeholder="Zip/Postal Code" value="<?php echo $user['zip'];?>"  required>
                    </div>
                </div>
    
                <div id="inp1">
                    <div id="inp1label">
                        <label for="citezenship">Citezenship</label>
                        <input type="text" id="citezenship" name="citezenship" placeholder="Citezenship" value="<?php echo $user['citizenship'];?>"  required>
                    </div>
                    
                    <div id="inp1label">
                        <label for="number">Contact No.</label>
                        <input type="number" id="number" name="number" placeholder="Enter your contact number" value="<?php echo $user['contact'];?>"  required>
                      </div>
    
                      <div id="inp1label">
                        <label for="telephone">Telephone No.</label>
                        <input type="telephone" id="telephone" name="telephone" placeholder="Optional" value="<?php echo $user['tel'];?>" >
                      </div>
                </div>

                <div id="inp1">
                    <h1>ACCOUNT INFORMATION</h1>
                </div>
    
                <div id="inp1">
                    <div id="inp1label">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo $user['email'];?>"  required>
                    </div>
    
                    <div id="inp1label">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" value="<?php echo $user['username'];?>"  required>
                    </div>
                  </div>
                </div>

                <button type="button" id="change-password-button" style="margin: -20px 30px 10px 30px;">Change Password</button>
                <button type="submit" style="margin:10px 30px 20px 30px;">Save</button>
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
                      <input type="hidden" id="email" name="email" placeholder="Enter your email" value="<?php echo $user['email'];?>"  required>
                    <div id="inp1label">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Current Password" required>
                    </div>
                </div>
                <div id="inp1">
                    <div id="inp1label">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                    </div>
                </div>
                <div id="inp1">
                    <div id="inp1label">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                </div>
                <button type="submit">Change Password</button>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        var firstname = $('#firstname').text();
        var intials = firstname.charAt(0);
        $('#profileimage').text(intials);
    }
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

        // Handle form submission
        $('#login-form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'phpexecution/updateprofile.php',
                data: formData,
                success: function(response) {
                    alert('Update ' + response);
                    if (response.trim() === 'Successful') {
                        window.location.href = 'https://barangay-433-zone-44.000webhostapp.com/Barangay/profileuser.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#change-password-form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'phpexecution/update_user_pass.php',
                data: formData,
                success: function(response) {
                    alert(response);
                    if (response.trim() === 'Successful') {
                         window.location.href = 'https://barangay-433-zone-44.000webhostapp.com/Barangay/profileuser.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
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
