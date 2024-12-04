<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login']; 
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    // si l'inici de sessió és un correu electrònic o un nom d'usuari
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        // Login amb un correu electrònic
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    } else {
        // Login amb un nom d'usuari
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    }
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['last_activity'] = time();

        if ($remember_me) {
            // Generar un token aleatori
            $token = bin2hex(random_bytes(50));
            $expiry = time() + (86400 * 30); // Token valid for 30 days

            // Guardar el token a la base de dades
            $stmt = $pdo->prepare("UPDATE users SET remember_token = ?, remember_token_expiry = ? WHERE id = ?");
            $stmt->execute([$token, $expiry, $user['id']]);

            // Estableix una cookie amb el token
            setcookie('remember_me', $token, $expiry, "/");
        }

        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid email or username and password!";
        header("Location: login.php");
        exit();
    }
}

require '../views/login.view.php';
?>