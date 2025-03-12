<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['mess'];

    // Email details
    $to = "albanajeremie22@gmail.com"; // Replace with your email address
    $subject = "User Support Request";
    $body = "Name: $name\n\nFrom: $email\n\nMessage:\n$message";

    // Send email
    if (mail($to, $subject, $body)) {
        echo'Successful';
    } else {
        echo 'Failed to send email, Please try again!.';
    }
}

?>