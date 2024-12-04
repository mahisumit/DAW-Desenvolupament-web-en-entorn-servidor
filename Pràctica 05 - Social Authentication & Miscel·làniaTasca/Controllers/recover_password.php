<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 
require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email_error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Comprova si l'usuari existeix
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $email_error = "Email does not exist!";
    } else {
        // Genera un token aleatori
        $token = bin2hex(random_bytes(50));
        $expiry = time() + 3600; // Token valid for 1 hour

        // Guarda el token a la base de dades
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $stmt->execute([$token, $expiry, $email]);

        // Envia un correu electrònic amb el token de restabliment de contrasenya (PHP Mailer)
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 's.mahi@sapalomera.cat'; // SMTP username
            $mail->Password = 'jzjw ulmb kmyz wllj'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('s.mahi@sapalomera.cat', 'Admin'); // Set the sender's email and name
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $reset_link = "http://localhost/p5/views/reset_password.view.php?token=$token";
            $mail->Body = "Click the following link to reset your password: <a href='$reset_link'>Reset Password</a>🔓";

            $mail->send();
            $success = "A password reset link has been sent to your email.";
        } catch (Exception $e) {
            $email_error = "Failed to send email. Please try again.";
        }
    }
}

require '../views/recover_password.view.php';
?>