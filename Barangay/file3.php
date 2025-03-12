<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/univfile.css">
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>Business Permit</title>
</head>
<body>
    <section id="for100vh">
        <a href="filerequest.php" class="button">Go Back</a>
        <div id="aboutsection">
            <form id="login-form" action="phpexecution/filerequest.php" method="POST">
            <h2>REQUEST FORM</h2>
            <p>Fill up all the details</p>

            <div id="inp1">
                <h1>Business Permit</h1>
                <input type="hidden" id="title" name="title" value="Business Permit">
                <input type="hidden" id="status" name="status" value="Pending">
                <input type="hidden" id="email" name="email" value="<?php echo $user['email']?>">
            </div>

            <div id="inp1">
                <div id="inp1label">
                    <label for="fullname">Full Name</label>
                    <input type="text" readonly id="fullname" name="fullname" placeholder="First name/Middle initial/Last name" value="<?php echo $user['first_name'].' '.substr($user['mid_name'], 0, 1).'. '.$user['last_name'];?>" required>
                </div>

                <div id="inp23label">
                    <label for="suffix">Suffix</label>
                    <select id="suffix" name="suffix">
                        <option value="" disabled selected></option>
                        <option value="Sr" <?php if ($user['suffix'] == 'Sr') echo 'selected'; ?>>Sr</option>
                        <option value="Jr" <?php if ($user['suffix'] == 'Jr') echo 'selected'; ?>>Jr</option>
                        <option value="I" <?php if ($user['suffix'] == 'I') echo 'selected'; ?>>I</option>
                        <option value="II" <?php if ($user['suffix'] == 'II') echo 'selected'; ?>>II</option>
                        <option value="III" <?php if ($user['suffix'] == 'III') echo 'selected'; ?>>III</option>
                        <option value="IV" <?php if ($user['suffix'] == 'IV') echo 'selected'; ?>>IV</option>
                    </select>
                </div>
            </div>
            
            <input type="hidden" id="dob" name="dob" value="<?php echo $user['birthdate']?>" required>
            <input type="hidden" id="age" name="age" placeholder="Age" value="<?php echo $user['age']?>" required>

            <div id="inp1">
                <div id="inp1label">
                    <label for="address">Address</label>
                    <textarea name="address" readonly id="address" required><?php echo $user['address'];?></textarea>
                </div>
            </div>
            
            <div id="inp1">
                <div id="inp1label">
                    <label for="sb_name">Store/Business Name</label>
                    <input type="text" id="sb_name" name="sb_name" placeholder="e.g. Sv Store" value="" required>
                </div>
            </div>
            
            <div id="inp1">
                <div id="inp1label">
                    <label for="purpose">Purpose of the request</label>
                        <select id="purpose" name="purpose" required>
                            <option value="" disabled selected>Select Purpose</option>
                            <option value="Employment">Employment</option>
                            <option value="Business Permits">Business Permits</option>
                            <option value="School Requirement">School Requirement</option>
                            <option value="Bank Transactions">Bank Transactions</option>
                            <option value="Loan Applications">Loan Applications</option>
                            <option value="Government Documents Application">Government Documents Application</option>
                            <option value="Utility Services Applications">Utility Services Applications</option>
                        </select>
                </div>
            </div>
            
            <div id="inp2">
                <input type="checkbox" id="checkbox" name="acceptterms" value="Accepted" required>
                <label for="acceptterms">I have read and agree to the <a href="terms-and-conditions.html" target="_blank">Terms and Conditions</a>.</label>
            </div>
            
            <div id="inp1">
                <button type="submit" style="background-color: rgb(0, 81, 69);">Request</button>
            </div>
            
        </form>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Show confirmation dialog
                var userConfirmed = confirm("Do you really want to proceed with this request?");
                if (!userConfirmed) {
                    return; // If user cancels, do nothing
                }

                // Serialize form data
                var formData = $(this).serialize();

                // Send form data to the server
                $.ajax({
                    type: 'POST',
                    url: 'phpexecution/filerequest.php',
                    data: formData,
                    success: function(response) {
                        // Handle server response
                        alert('Request ' + response);
                        if (response.trim() === 'Successful') { // Ensure that 'Successful' is returned exactly
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
    </script>
</body>
</html>
