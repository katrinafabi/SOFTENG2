<?php
require_once('phpexecution/uniretrieve.php');

$id = $_POST['id'];
$timestamp = $_POST['timestamp'];
$file_code = $_POST['file_code'];
$reason = $_POST['reason'];
$status = $_POST['status'];
$address = $_POST['address'];
$name = $_POST['name'];
$birthdate = $_POST['birthdate'];
$age = $_POST['age'];
$suffix = isset($_POST['suffix']) ? $_POST['suffix'] : '';
$file_id = $_POST['file_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/univfile.css">
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>Check Request</title>
    <style>
        /* CSS for the overlay */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent black */
            z-index: 1000; /* ensure the overlay is on top of everything */
        }
        
        #reasonSelect {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section id="for100vh">
        <a href="server-dashboard-onprocess.php" class="button">Go Back</a>
        <div id="aboutsection">
            <form id="file1-form" action="phpexecution/completerequest.php" method="POST">
                <h2>CHECK REQUEST</h2>
                <p>Double check for mistakes or shady information</p>

                <div id="inp1">
                    <h1><?php echo htmlspecialchars($file_code); ?></h1>
                    <input type="hidden" id="status" name="status" value="Pending">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <input type="hidden" name="timestamp" value="<?php echo htmlspecialchars($timestamp); ?>">
                    <input type="hidden" id="title" name="title" value="<?php echo htmlspecialchars($file_code); ?>">
                    <input type="hidden" name="status" value="<?php echo htmlspecialchars($status); ?>">
                    <input type="hidden" name="file_id" value="<?php echo htmlspecialchars($file_id); ?>">
                    <input type="hidden" id="denyReasonInput" name="denyReason" value="">
                </div>

                <div id="inp1">
                    <div id="inp1label">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="First name/Middle initial/Last name" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>

                    <div id="inp23label">
                        <label for="suffix">Suffix</label>
                        <select id="suffix" name="suffix">
                            <option value="" disabled selected></option>
                            <option value="Sr" <?php if ($suffix == 'Sr') echo 'selected'; ?>>Senior</option>
                            <option value="Jr" <?php if ($suffix == 'Jr') echo 'selected'; ?>>Junior</option>
                            <option value="I" <?php if ($suffix == 'I') echo 'selected'; ?>>I</option>
                            <option value="II" <?php if ($suffix == 'II') echo 'selected'; ?>>II</option>
                            <option value="III" <?php if ($suffix == 'III') echo 'selected'; ?>>III</option>
                            <option value="IV" <?php if ($suffix == 'IV') echo 'selected'; ?>>IV</option>
                        </select>
                    </div>
                </div>
                
                <input type="hidden" id="dob" name="dob" value="<?php echo htmlspecialchars($birthdate); ?>" required>
                <input type="hidden" id="age" name="age" placeholder="Age" value="<?php echo htmlspecialchars($age); ?>" required>

                <div id="inp1">
                    <div id="inp1label">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" required><?php echo htmlspecialchars($address); ?></textarea>
                    </div>
                </div>

                <div id="inp1">
                    <div id="inp1label">
                        <label for="purpose">Purpose of the request</label>
                        <select id="purpose" name="purpose" required>
                            <option value="" disabled>Select Purpose</option>
                            <option value="Employment" <?php if ($reason == 'Employment') echo 'selected'; ?>>Employment</option>
                            <option value="Business Permits" <?php if ($reason == 'Business Permits') echo 'selected'; ?>>Business Permits</option>
                            <option value="School Requirement" <?php if ($reason == 'School Requirement') echo 'selected'; ?>>School Requirement</option>
                            <option value="Bank Transactions" <?php if ($reason == 'Bank Transactions') echo 'selected'; ?>>Bank Transactions</option>
                            <option value="Loan Applications" <?php if ($reason == 'Loan Applications') echo 'selected'; ?>>Loan Applications</option>
                            <option value="Government Documents Application" <?php if ($reason == 'Government Documents Application') echo 'selected'; ?>>Government Documents Application</option>
                            <option value="Utility Services Applications" <?php if ($reason == 'Utility Services Applications') echo 'selected'; ?>>Utility Services Applications</option>
                        </select>
                    </div>
                </div>
                
                <div id="inp1">
                    <input type="hidden" id="confirmdel" name="del" value="">
                    <button type="button" style="background-color: rgb(0, 81, 69);" onclick="submitDenyReason()">RESUBMIT REQUEST</button>
                </div>

                <div id="inp1">
                    <input type="hidden" id="confirmInput" name="confirm" value="">
                    <button type="button" style="background-color: red;" onclick="confirmDelete()">DELETE REQUEST</button>
                </div>
            </form>
        </div>
    </section>
    
    <script>

        function submitDenyReason() {
            var confirmation = confirm("Are you sure you want to resubmit this request?");
            if (confirmation) {
                document.getElementById("confirmdel").value = "yes";
                document.getElementById("file1-form").action = "phpexecution/fileedit.php";
                document.getElementById("file1-form").submit();
            }
        }
        
        function confirmDelete() {
            var confirmation = confirm("Are you sure you want to delete this request?");
            if (confirmation) {
                // If user confirms, set a hidden input value to 'yes' and submit the form
                document.getElementById("confirmInput").value = "yes";
                document.getElementById("file1-form").submit();
            }
        }
    </script>
</body>
</html>
