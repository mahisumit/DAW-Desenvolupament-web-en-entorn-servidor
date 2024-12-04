<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

// Varíables per a errors i èxit
$email_error = $current_password_error = $new_password_error = $confirm_password_error = '';
$email = '';
$current_password = '';
$new_password = '';
$confirm_password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Força de la contrasenya
    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    if (!preg_match($password_regex, $new_password)) {
        $new_password_error = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    if ($new_password !== $confirm_password) {
        $confirm_password_error = "Passwords do not match!";
    }

    // Per comprovar si l'email existeix
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $email_error = "Email does not exist!";
    } else {
        // Comprova si la contrasenya actual és correcta
        if (!password_verify($current_password, $user['password'])) {
            $current_password_error = "Current password is incorrect!";
        }
    }

    if (empty($email_error) && empty($current_password_error) && empty($new_password_error) && empty($confirm_password_error)) {
        // Actualitza la contrasenya
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashed_password, $email]);
        $success = "Password changed successfully!";
    }
}

require '../views/changepswd.view.php';
?>