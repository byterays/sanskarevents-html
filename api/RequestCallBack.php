<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload PHPMailer (assuming vendors is in wwwroot)
require_once __DIR__ . '/../vendor/autoload.php';

// Load mail config from config/mail.php
$config = require __DIR__ . '/../config/mail.php';

// Basic spam check: honeypot
if (!empty($_POST['form_botcheck'])) {
     echo json_encode([
        'success' => false,
        'message' => 'Bot Detected!'
    ]);
    exit;
}

// Sanitize input
$name = htmlspecialchars(trim($_POST['form_name'] ?? ''));
$phone = htmlspecialchars(trim($_POST['form_phone'] ?? ''));
$email = filter_var(trim($_POST['form_email'] ?? ''), FILTER_VALIDATE_EMAIL);
$subject = htmlspecialchars(trim($_POST['form_subject'] ?? ''));
$message = htmlspecialchars(trim($_POST['form_message'] ?? ''));

// Required fields
if (empty($name) || empty($phone)) {
    echo json_encode([
        'success' => false,
        'message' => 'Name and phone are required.'
    ]);
    exit;
}

// Prepare email body
$emailBody = "
  <h2>New Contact Request</h2>
  <p><strong>Name:</strong> $name</p>
  <p><strong>Phone:</strong> $phone</p>
  <p><strong>Email:</strong> " . ($email ?: 'Not provided') . "</p>
  <p><strong>Message:</strong><br>$message</p>
";

// Send to Admin

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $config['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp_user'];
    $mail->Password = $config['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL for port 465
    $mail->Port = $config['smtp_port'];

    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress($config['admin_email'], $config['admin_name']);
    if ($email) {
        $mail->addReplyTo($email, $name);
    }

    $mail->isHTML(true);
    $mail->Subject = $subject; //'New Contact Form Submission';
    $mail->Body = $emailBody;
    $mail->AltBody = strip_tags($emailBody);
    $mail->addCustomHeader('X-Originating-IP', $_SERVER['REMOTE_ADDR']);

    try {
        $mail->send();
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $mail->ErrorInfo
        ]);
        exit;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Message sent successfully.'
    ]);
    

    exit;
?>