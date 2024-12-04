<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

$new_password_error = $confirm_password_error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Pass strength (fortaleza de la contraseña)
    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    if (!preg_match($password_regex, $new_password)) {
        $new_password_error = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    if ($new_password !== $confirm_password) {
        $confirm_password_error = "Passwords do not match!";
    }

    // Comprova si el token és vàlid
    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > ?");
    $stmt->execute([$token, time()]);
    $user = $stmt->fetch();

    if (!$user) {
        $new_password_error = "Invalid or expired token!";
    }

    if (empty($new_password_error) && empty($confirm_password_error)) {
        // Actualitza la contrasenya de l'usuari
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
        $stmt->execute([$hashed_password, $token]);
        $success = "Password reset successfully!";
    }
}

require '../views/reset_password.view.php';
?>