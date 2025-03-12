<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, generate a reset token
        $token = bin2hex(random_bytes(32)); // Generate a random token
        $expires = date("U") + 1800; // Token expires in 30 minutes

        // Insert the reset token into the database
        $sql = "INSERT INTO password_reset (email, token, expires) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $email, $token, $expires);
        $stmt->execute();

        // Send reset email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // Set to 0 for production use
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'albanajeremie22@gmail.com'; // Your Gmail address
            $mail->Password = 'udwionlhkmnlfojb'; // Your Gmail password or app-specific password

            $mail->setFrom('albanajeremie22@gmail.com', 'Barangay 433 Zone 44');
            $mail->addAddress($email); // Recipient email

            $mail->Subject = 'Password Reset Request';

            // Create the HTML body
            $mail->isHTML(true); // Set email format to HTML
            $mail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .container { width: 100%; padding: 20px; background-color: #f4f4f4; }
                    .content { background-color: #ffffff; padding: 20px; border-radius: 10px; }
                    .header { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
                    .footer { margin-top: 20px; font-size: 12px; color: #888888; }
                    .label { font-weight: bold; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='content'>
                        <div class='header'>Password Reset Request</div>
                        <p>To reset your password, please click the link below:</p>
                        <p><a href='https://barangay-433-zone-44.000webhostapp.com/Barangay/reset-password.php?token=$token'>Reset Password</a></p>
                    </div>
                    <div class='footer'>
                        This email was sent from Barangay 433 Zone 44 website.
                    </div>
                </div>
            </body>
            </html>
            ";

            // For clients that do not support HTML emails
            $mail->AltBody = "To reset your password, please click the link below:\nhttp://yourwebsite.com/reset_password.php?token=$token";

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            if ($mail->send()) {
                echo 'An email with reset instructions has been sent to your email address.';
            } else {
                echo 'Failed to send email, Please try again!';
            }
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'This email address is not registered.';
    }

    $stmt->close();
}

$conn->close();
?>
