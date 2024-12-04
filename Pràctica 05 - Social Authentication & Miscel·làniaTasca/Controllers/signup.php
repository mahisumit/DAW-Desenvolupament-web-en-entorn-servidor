<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

$username_error = $email_error = $password_error = $confirm_password_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Password strength 
    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    if (!preg_match($password_regex, $password)) {
        $password_error = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    if ($password !== $confirm_password) {
        $confirm_password_error = "Passwords do not match!";
    }

    // Comprova si l'usuari ja existeix 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();

    if ($user) {
        if ($user['username'] === $username) {
            $username_error = "Username already exists!";
        }
        if ($user['email'] === $email) {
            $email_error = "Email already exists!";
        }
    }

    if (empty($username_error) && empty($email_error) && empty($password_error) && empty($confirm_password_error)) {
        // Registra l'usuari
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);
        $success = "User registered successfully!";
    }
}

require '../views/signup.view.php';
?>