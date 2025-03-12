<?php

require_once('uniretrieve.php');
include 'db_connection.php';

// Get the data from the POST request
$id = $_POST['id'];
$file_code = $_POST['file_code'];
$reason = $_POST['reason'];
$address = strtoupper($_POST['address']);
$name = strtoupper($_POST['name']);
$birthdate = $_POST['birthdate'];
$file_id = $_POST['file_id'];

date_default_timezone_set('Asia/Manila');

// Get the current date and time in the desired format
$current_datetime = date('Y-m-d h:i:s');

// Update user_activty table
$update_query = "UPDATE user_activty SET status = 'Completed', `date_issued` = '$current_datetime', notified = 0 WHERE id = $id AND file_id = $file_id";

if ($conn->query($update_query) === TRUE) {
        
        $activity_message = "You've claimed your request for '$title', Succesfully.";
        $forwho = "user"; // Static value for forwho
        $activity_insert_query = "INSERT INTO activity_log (user_id, message, forwho, timestamp) VALUES (?, ?, ?, ?)";
        $activity_stmt = $conn->prepare($activity_insert_query);
        $activity_stmt->bind_param("isss", $id, $activity_message, $forwho, $current_datetime);
        $activity_stmt->execute();
        $activity_stmt->close();
        
        $activity_message = "User $name have claimed the request for '$title',  Succesfully.";
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
    <title>First Time Jobseeker Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 24px;
            text-align: center;
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
    </style>
</head>
<body>
    <section class="certification" style="margin-bottom: 24px;">
        <div class="letterhead">
            <h2>Republic of the Philippines</h2>
            <h2>BARANGAY 433 ZONE 44</h2>
            <p>Sampaloc Manila</p>
        </div>
        <hr>
        <h1>BARANGAY CERTIFICATION</h1>
        <h2>(First Time Jobseekers Assistance Act- RA 11261)</h2>
        <p class="indent">This is to certify that Mr./Ms <strong><?php echo htmlspecialchars($name); ?></strong>, <strong class="replace-age"></strong> YRS. OLD with address at <strong><?php echo htmlspecialchars($address); ?></strong>, is a bonafide resident of Barangay 433 Zone 44 District IV Manila for years and is a qualified availee of RA 11261 or the First Time Jobseekers Act of 2019.</p>
        <p class="indent">I further certify that the holder/bearer was informed of his/her rights including the duties and responsibilities accorded by RA 11261 through the Oath of Undertaking he/she has signed and executed in the presence of our Barangay Official.</p>
        <p>Issued this <strong class="replace-today-day"></strong> day of <strong class="replace-today-month"></strong> <strong class="replace-today-year"></strong>, City of Manila.</p>
        <p>This certification is valid only for <strong class="replace-next-year-month"></strong> <strong class="replace-next-year-day"></strong>, <strong class="replace-next-year-year"></strong> 1 (one) year from the issuance.</p>
        <div class="signature">
            <div class="insidesignature">
                <p style="margin-top:88px;"><strong>JUDE TUCIONE L. GARCIA</strong></p>
                <p style="margin-bottom: 32px;">Punong Barangay</p>
                <p style="margin-bottom: 24px;">Witnessed by:</p>
                <p><strong>MARICAR O. TAPANG</strong></p>
                <p>Barangay Secretary<</p>
            </div>
        </div>
    </section>
    
    <section class="oath">
        <h2>OATH OF UNDERTAKING</h2>
        <p class="indent">I, <strong><?php echo htmlspecialchars($name); ?></strong>, a resident of <strong><?php echo htmlspecialchars($address); ?></strong>, Barangay 433 Zone 44 District IV Manila for years, availing the benefits of Republic Act 11261 otherwise known as the First Time Jobseekers Act of 2019 do hereby declare, agree, and undertake to abide and be bound by the following:</p>
        <ol>
            <li>That this is the first time that I will actively look for a job and therefore requesting that a Barangay Certification be issued in my favor to avail the benefits of the law;</li>
            <li>That I am aware that the benefit and privilege/s under the said law shall be valid only for one (1) year from the date that the Barangay certification is issued;</li>
            <li>That I can avail the benefits of the law only once;</li>
            <li>That I understand that my personal information shall be included in the Roster/List of First Time Jobseekers and will not be used for any unlawful purpose;</li>
            <li>That I will inform and/or report to the Barangay personally through text or other means or through my family/Relatives once I am employed; and</li>
            <li>That I am not a beneficiary of the Job Start Program under R.A No. 10869 and other laws that give similar exemption for the documents or transaction exempted under R.A. 11261</li>
            <li>That if issued the requested Certification I will not use the same in any fraud neither falsify nor help/or assist in the fabrication of the said certification.</li>
            <li>That this undertaking is made solely for the purposes of obtaining a Barangay Certificate consistent with the objective of R.A. 11261 and not for any other purposes.</li>
            <li>That I consent to the use of my personal information pursuant to the Data Privacy Act and other Applicable laws, rules, and regulations.</li>
        </ol>
        
        <div class="signature">
            <div class="insidesignature">
                <p style="margin-top:72px;"><strong>JUDE TUCIONE L. GARCIA</strong></p>
                <p style="margin-bottom: 32px;">Punong Barangay</p>
                <p style="margin-bottom: 24px;">Witnessed by:</p>
                <p><strong>MARICAR O. TAPANG</strong></p>
                <p>Barangay Secretary</p>
            </div>
        </div>
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
            var day = today.getDate().toString().padStart(2, '0');  // Ensures 2 digits
            var dayWithSuffix = day + getOrdinalSuffix(parseInt(day));
            var month = today.toLocaleString('default', { month: 'long' }).toUpperCase();
            var year = today.getFullYear();

            // Calculate date after 1 year
            var nextYear = new Date(today);
            nextYear.setFullYear(nextYear.getFullYear() + 1);
            var nextYearDate = nextYear.getDate().toString().padStart(2, '0');  // Ensures 2 digits
            var nextYearMonth = nextYear.toLocaleString('default', { month: 'long' }).toUpperCase();
            var nextYearYear = nextYear.getFullYear();

            // Replace placeholders with calculated values
            document.querySelectorAll('.replace-age').forEach(function(element) {
                element.innerText = age;
            });
            document.querySelectorAll('.replace-name').forEach(function(element) {
                element.innerText = name;
            });
            document.querySelectorAll('.replace-address').forEach(function(element) {
                element.innerText = address;
            });

            // Replace placeholders with today's date and date after 1 year
            document.querySelectorAll('.replace-today-day').forEach(function(element) {
                element.innerText = dayWithSuffix;
            });
            document.querySelectorAll('.replace-today-month').forEach(function(element) {
                element.innerText = month;
            });
            document.querySelectorAll('.replace-today-year').forEach(function(element) {
                element.innerText = year;
            });
            document.querySelectorAll('.replace-next-year-day').forEach(function(element) {
                element.innerText = nextYearDate;
            });
            document.querySelectorAll('.replace-next-year-month').forEach(function(element) {
                element.innerText = nextYearMonth;
            });
            document.querySelectorAll('.replace-next-year-year').forEach(function(element) {
                element.innerText = nextYearYear;
            });

            // Combine content from both sections into one element
            var certificationContent = document.querySelector('.certification').innerHTML;
            var oathContent = document.querySelector('.oath').innerHTML;
            var combinedContent = certificationContent + '<div style="page-break-before: always;"></div>' + oathContent;

            // Get today's date components
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');  // Ensures 2 digits
            var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because January is 0
            var year = today.getFullYear();
        
            // Get name and file code from PHP (assuming these values are already retrieved)
            var name = "<?php echo htmlspecialchars($name); ?>";
            var fileCode = "<?php echo htmlspecialchars($file_code); ?>";
        
            // Construct the filename
            var filename = name + '_' + fileCode + '_' + year + month + day + '.pdf';
        
            // Create a PDF with combined content using html2pdf
            var options = {
                margin:       [0.75, 0.5], // [top, left, bottom, right]
                filename:     filename,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 4, logging: true, dpi: 192, letterRendering: true },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' } // Use A4 paper size
            };
        
            html2pdf().from(combinedContent).set(options).save().then(function() {
                // After the PDF is generated and saved, redirect to another page
                window.location.href = "/Server/server-dashboard-completed.php";
            });
        };
    </script>
</body>
</html>