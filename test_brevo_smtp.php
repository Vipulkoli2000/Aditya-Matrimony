<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                           // Send using SMTP
    $mail->Host       = 'smtp-relay.brevo.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                  // Enable SMTP authentication
    $mail->Username   = '8e53ea001@smtp-brevo.com'; // SMTP username
    $mail->Password   = 'ZaQpMKH7XgFRG4Pq';   // SMTP password
    $mail->SMTPSecure = 'tls';                 // Enable TLS encryption
    $mail->Port       = 587;                   // TCP port to connect to

    // Recipients
    $mail->setFrom('noreply@marathavivahmandaldombivli.com', 'Matrimony');
    $mail->addAddress('your-email@example.com'); // Add a recipient - REPLACE WITH YOUR EMAIL

    // Content
    $mail->isHTML(true);                       // Set email format to HTML
    $mail->Subject = 'Brevo SMTP Test';
    $mail->Body    = 'This is a test email to verify Brevo SMTP settings are working correctly.';

    $mail->send();
    echo "Message has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
