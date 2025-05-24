<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'vendor/autoload.php'; // Make sure you've installed PHPMailer via Composer

// Your SMTP config
$config = [
    'smtp_host'   => 'mail.sanskarevents.in',
    'smtp_user'   => 'query@sanskarevents.in',
    'smtp_pass'   => 'HVtq%;%QCZuF',
    'smtp_port'   => 465,
    'from_email'  => 'query@sanskarevents.in',
    'from_name'   => 'Sanskar Events & Celebrations',
    'admin_email' => 'info@sanskarevents.in',
    'admin_name'  => 'Sanskar Events & Celebrations',
];

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_user'];
    $mail->Password   = $config['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL for port 465
    $mail->Port       = $config['smtp_port'];

    // Recipients
    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress($config['admin_email'], $config['admin_name']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from Sanskar Events';
    $mail->Body    = 'This is a <b>test email</b> using PHPMailer and your SMTP config.';
    $mail->AltBody = 'This is a test email using PHPMailer and your SMTP config.';

    $mail->send();
    echo '✅ Test email sent successfully.';
} catch (Exception $e) {
    echo '❌ Email could not be sent. PHPMailer Error: ' . $mail->ErrorInfo;
}
