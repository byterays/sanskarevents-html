<?php
require '../vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// Validate honeypot
if (!empty($_POST['form_botcheck'])) {
    exit('Bot Detected!');
}

// Sanitize input
$name    = htmlspecialchars(trim($_POST['form_name'] ?? ''));
$phone   = htmlspecialchars(trim($_POST['form_phone'] ?? ''));
$email   = filter_var(trim($_POST['form_email'] ?? ''), FILTER_VALIDATE_EMAIL);
$message = htmlspecialchars(trim($_POST['form_message'] ?? ''));

// Validate required fields
if (empty($name) || empty($phone)) {
    exit('Name and phone are required.');
}

// Build email body
$emailBody = "
  <h2>New Contact Request</h2>
  <p><strong>Name:</strong> $name</p>
  <p><strong>Phone:</strong> $phone</p>
  <p><strong>Email:</strong> " . ($email ?: 'Not provided') . "</p>
  <p><strong>Message:</strong><br>$message</p>
";

// SMTP settings
$smtpHost = 'smtp.yourdomain.com';
$smtpUser = 'your-email@yourdomain.com';
$smtpPass = 'your-app-password';
$smtpPort = 587;
$adminEmail = 'admin@yourdomain.com';
$adminName  = 'Site Admin';

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpUser;
    $mail->Password   = $smtpPass;
    $mail->SMTPSecure = 'tls';
    $mail->Port       = $smtpPort;

    $mail->setFrom($smtpUser, 'Website Contact Form');
    $mail->addAddress($adminEmail, $adminName);

    if ($email) {
        $mail->addReplyTo($email, $name);
    }

    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body    = $emailBody;
    $mail->AltBody = strip_tags($emailBody);
    $mail->addCustomHeader('X-Mailer', 'PHP/' . phpversion());
    $mail->addCustomHeader('X-Originating-IP', $_SERVER['REMOTE_ADDR']);

    $mail->send();

    // Send confirmation email to sender if email provided
    if ($email) {
        $confirm = new PHPMailer(true);
        $confirm->isSMTP();
        $confirm->Host       = $smtpHost;
        $confirm->SMTPAuth   = true;
        $confirm->Username   = $smtpUser;
        $confirm->Password   = $smtpPass;
        $confirm->SMTPSecure = 'tls';
        $confirm->Port       = $smtpPort;

        $confirm->setFrom($smtpUser, 'Your Company Name');
        $confirm->addAddress($email, $name);
        $confirm->isHTML(true);
        $confirm->Subject = 'Thank you for contacting us';
        $confirm->Body    = "
          <p>Hi $name,</p>
          <p>Thank you for reaching out. We have received your message and will get back to you shortly.</p>
          <p><strong>Your Message:</strong><br>" . nl2br($message) . "</p>
          <br><p>Regards,<br>Your Company Team</p>";
        $confirm->AltBody = strip_tags($message);

        $confirm->send();
    }

    echo 'Message sent successfully.';
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
