<?php

require_once('uniretrieve.php');
include 'db_connection.php';

// Get the data from the POST request
$id = $_POST['id'];
$file_code = $_POST['file_code'];
$reason = $_POST['reason'];
$address = strtoupper($_POST['address']);
$name = strtoupper($_POST['name']);
$lname = $_POST['name'];
$birthdate = $_POST['birthdate'];
$file_id = $_POST['file_id'];

date_default_timezone_set('Asia/Manila');

// Get the current date and time in the desired format
$current_datetime = date('Y-m-d h:i:s');

// Update user_activity table
$update_query = "UPDATE user_activty SET status = 'Completed', `date_issued` = '$current_datetime', notified = 0 WHERE id = $id AND file_id = $file_id";

if ($conn->query($update_query) === TRUE) {
    
        $activity_message = "You've claimed your request for '$file_code', Succesfully.";
        $forwho = "user"; // Static value for forwho
        $activity_insert_query = "INSERT INTO activity_log (user_id, message, forwho, timestamp) VALUES (?, ?, ?, ?)";
        $activity_stmt = $conn->prepare($activity_insert_query);
        $activity_stmt->bind_param("isss", $id, $activity_message, $forwho, $current_datetime);
        $activity_stmt->execute();
        $activity_stmt->close();
        
        $activity_message = "User $lname have claimed the request for '$file_code',  Succesfully.";
        $forwho = "admin"; // Static value for forwho
        $activity_insert_query = "INSERT INTO activity_log (user_id, message, forwho, timestamp) VALUES (?, ?, ?, ?)";
        $activity_stmt = $conn->prepare($activity_insert_query);
        $activity_stmt->bind_param("isss", $id, $activity_message, $forwho, $current_datetime);
        $activity_stmt->execute();
        $activity_stmt->close();
        
} else {
    // Error handling
    echo "Error updating user activity: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="server-css/pictures/Logo/brgylogo.svg">
    <title>Barangay Clearance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom:48px;
        }
        h2 {
            margin-top:0;
            font-size: 22px;
            text-align: center;
            margin-bottom:24px;
        }
        p, ol{
            font-size: 17px;
            text-align: justify;
            font-weight:500px;
        }
        .indent{
            text-indent: 48px;
        }
        .signature {
            margin-right:48px;
            float:right;
        }
        .insidesignature{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
        .signature p {
            margin:0;
            text-align: right;
            font-size:12px;
        }
        .signature strong {
            font-size:14px;
            font-weight:bold;
        }
        strong{
            font-size:19px;
            text-decoration: underline;
        }
        hr{
            border: 1px solid black;
            margin-bottom: 32px;
        }
        .letterhead{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .letterhead p{
            margin: 0;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .letterhead h2{
            margin: 0;
            margin-bottom: 4px;
            font-size: 14px;
        }
        section{
            margin:24px 48px;
            height:94vh;
        }
        h6{
            margin-top: 284px;
            font-size:8px;
            text-align:center;
            margin-bottom:0;
        }
    </style>
</head>
<body>
    <section class="certification">
        <div class="letterhead">
            <h2>Republic of the Philippines</h2>
            <h2>BARANGAY 433 ZONE 44</h2>
            <p>Sampaloc Manila</p>
        </div>
        <hr>
        <h2>OFFICE OF THE PUNONG BARANGAY</h2>
        <h1>BARANGAY CLEARANCE</h1>
        <h3>TO WHOM IT MAY CONCERN:</h3>
        <p class="indent">This is to certify that <strong><?php echo htmlspecialchars($name); ?></strong>, <strong class="replace-age"></strong> YRS. OLD, is a bonafide resident of BARANGAY 433 ZONE 44, DISTRICT IV MANILA with postal address at <strong><?php echo htmlspecialchars($address); ?></strong>.</p>
        <p class="indent">It is further certified that the above named person is of good moral character and law-abiding citizen in the community. To certify further, that he/she has no derogatory and/or criminal records filed in this barangay.</p>
        <p class="indent">This certification is being issued upon the request of the bearer for: AS PER REQUIREMENTS AND/OR TO SUPPORT HIS/HER;</p>
        <p style="margin-top:40px;">Purpose: <strong><?php echo htmlspecialchars($reason); ?></strong></p>
        <p style="margin-top:40px;">IN WITNESS WHEREOF I have hereunto set my hand and affixed the Official Seal of this office. Done in Barangay 433 Zone 44, District IV, Manila this <strong class="replace-today-day"></strong> day of <strong class="replace-today-month"></strong>, <strong class="replace-today-year"></strong></p>
        <div class="signature">
            <div class="insidesignature">
                <p style="margin-top:120px;"><strong>JUDE TUCIONE L. GARCIA</strong></p>
                <p>Punong Barangay</p>
            </div>
        </div>
        <h6>NOT VALID WITHOUT THE OFFICIAL SEAL OF THE BARANGAY</h6>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        window.onload = function() {
            // Get values from PHP
            var name = "<?php echo htmlspecialchars($name); ?>";
            var address = "<?php echo htmlspecialchars($address); ?>";
            var birthdate = new Date("<?php echo htmlspecialchars($birthdate); ?>");

            // Calculate age
            var today = new Date();
            var age = today.getFullYear() - birthdate.getFullYear();
            var monthDiff = today.getMonth() - birthdate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }

            // Function to get ordinal suffix
            function getOrdinalSuffix(day) {
                if (day > 3 && day < 21) return 'th';
                switch (day % 10) {
                    case 1: return 'st';
                    case 2: return 'nd';
                    case 3: return 'rd';
                    default: return 'th';
                }
            }

            // Get today's date components
            var day = today.getDate().toString().padStart(2, '0');
            var dayWithSuffix = day + getOrdinalSuffix(parseInt(day));
            var month = today.toLocaleString('default', { month: 'long' }).toUpperCase();
            var year = today.getFullYear();

            // Replace placeholders with calculated values
            document.querySelectorAll('.replace-age').forEach(function(element) {
                element.innerText = age;
            });

            document.querySelectorAll('.replace-today-day').forEach(function(element) {
                element.innerText = dayWithSuffix;
            });
            document.querySelectorAll('.replace-today-month').forEach(function(element) {
                element.innerText = month;
            });
            document.querySelectorAll('.replace-today-year').forEach(function(element) {
                element.innerText = year;
            });

            // Combine content from both sections into one element
            var certificationContent = document.querySelector('.certification').innerHTML;

            // Get today's date components
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var month = (today.getMonth() + 1).toString().padStart(2, '0');
            var year = today.getFullYear();
        
            // Get name and file code from PHP
            var name = "<?php echo htmlspecialchars($name); ?>";
            var fileCode = "<?php echo htmlspecialchars($file_code); ?>";
        
            // Construct the filename
            var filename = name + '_' + fileCode + '_' + year + month + day + '.pdf';
        
            // Create a PDF with combined content using html2pdf
            var options = {
                margin:       [0.75, 0.5],
                filename:     filename,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 4, logging: true, dpi: 192, letterRendering: true },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().from(certificationContent).set(options).save().then(function() {
                // After the PDF is generated and saved, redirect to another page
                window.location.href = "/Server/server-dashboard-completed.php";
            });
        };
    </script>
</body>
</html>