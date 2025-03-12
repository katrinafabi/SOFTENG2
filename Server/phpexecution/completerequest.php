<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

include 'db_connection.php';

date_default_timezone_set('Asia/Manila');
$current_timestamp = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $file_id = $_POST['file_id'];
    $status = 'For Pickup';

    // Generate a unique reference number
    $reference_number = generateReferenceNumber($id, $file_id);

    // Fetch user's email from the database
    $stmt = $conn->prepare("SELECT email FROM user WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $email = $user['email'];

    // Update the status and reference number in the database
    $stmt = $conn->prepare("UPDATE user_activty SET status = ?, reference_number = ? WHERE id = ? AND file_id = ?");
    $stmt->bind_param('ssii', $status, $reference_number, $id, $file_id);

    if ($stmt->execute()) {
        // Send email to the user
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // Set to 0 for production use
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'albanajeremie22@gmail.com'; // Your Gmail address
            $mail->Password = 'udwionlhkmnlfojb'; // Your Gmail password or app-specific password

            $mail->setFrom('albanajeremie22@gmail.com', 'Barangay 433 Zone 44');
            $mail->addAddress($email); // Add recipient

            $mail->Subject = 'Pickup Schedule Confirmation';

            // Create the HTML body
            $mail->isHTML(true);
            $mail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .container { width: 100%; padding: 20px; background-color: #f4f4f4; }
                    .content { background-color: #ffffff; padding: 20px; border-radius: 10px; }
                    h3{ text-align:center; margin-bottom:32px; }
                    .header { font-size: 24px; font-weight: bold; margin-bottom: 20px; text-align:center;}
                    .footer { margin-top: 20px; font-size: 12px; color: black; }
                    .label { font-weight: bold; font-size: 14px; }
                    .importantinfo{ background-color:#00AF00; border-radius:8px; color:white; padding:10px 20px 10px 20px;}
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='content'>
                        <div class='header'>Pickup Schedule Confirmation</div>
                        <h3>Thank you for using our services!</h3>
                        <p>Please take note of the following informations:</p>
                          <div class='importantinfo'>
                            <p>Reference Number: <span class='label'>$reference_number</span></p>
                            <p>File ID: <span class='label'>$file_id</span></p>
                          </div>
                        <p>Your certificate for <span class='label'>$title</span> has been scheduled for pickup.</p>
                        <p>Pickups are available on weekdays <span class='label' style='color:red;'>(MONDAY - FRIDAY)</span> during working hours <span class='label' style='color:red;'>(10AM - 5PM)</span>, except during Holidays.</p>
                        <p><span class='label' style='color:red;'>*IMPORTANT*:</span> Please bring any goverment issued <span class='label'>identification card (ID)</span> for verfication purposes</p>
                    </div>
                    <div class='footer'>
                        This email was sent from Baragay 433 Zone 44 website.
                    </div>
                </div>
            </body>
            </html>
            ";

            // For clients that do not support HTML emails
            $mail->AltBody = "Reference Number: $reference_number\n\nYour request has been scheduled for pickup.\n\nPickups are available on weekdays during working hours.";

            // Optional: Attachments
            // $mail->addAttachment('/path/to/file');

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            if ($mail->send()) {
                $activity_message = "Your request for '$title', has been Scheduled For Pickup.";
                $forwho = "user"; // Static value for forwho
                $activity_insert_query = "INSERT INTO activity_log (user_id, message, forwho, timestamp) VALUES (?, ?, ?, ?)";
                $activity_stmt = $conn->prepare($activity_insert_query);
                $activity_stmt->bind_param("isss", $id, $activity_message, $forwho, $current_timestamp);
                $activity_stmt->execute();
                $activity_stmt->close();
                
                echo "<script>
                        setTimeout(function() {
                            alert('Scheduled for pickup. Reference Number: $reference_number');
                            window.location.href = '/Server/server-dashboard-pickup.php';
                        }, 1000);
                      </script>";
            } else {
                echo 'Failed to send email, Please try again!';
            }
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

function generateReferenceNumber($id, $file_id) {
    return 'REF' . time() . $id . $file_id;
}
?>
