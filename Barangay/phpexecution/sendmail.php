<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['mess'];

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

        $mail->setFrom("$email", 'Barangay 433 Zone 44');
        $mail->addAddress('albanajeremie22@gmail.com', "Mr. Albana"); // Recipient email and name

        $mail->Subject = 'User Support Request';

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
                    <div class='header'>New Support Request</div>
                    <p><span class='label'>Name:</span> $name</p>
                    <p><span class='label'>From:</span> $email</p>
                    <p><span class='label'>Message:</span></p>
                    <p>$message</p>
                </div>
                <div class='footer'>
                    This email was sent from Barangay 433 Zone 44 website.
                </div>
            </div>
        </body>
        </html>
        ";

        // For clients that do not support HTML emails
        $mail->AltBody = "Name: $name\nFrom: $email\n\nMessage:\n$message";

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
            echo 'Successful';
        } else {
            echo 'Failed to send email, Please try again!';
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
