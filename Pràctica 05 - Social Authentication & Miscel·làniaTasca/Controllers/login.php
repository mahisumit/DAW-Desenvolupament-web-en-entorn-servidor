<?php
// Sumit Mahi
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        // iniciar sessió amb correu electrònic
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    } else {
        // iniciar sessió amb nom d'usuari
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

            // Establir una cookie "Recorda'm"
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

// Check if the user has a "Remember Me" cookie
if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_token = ? AND remember_token_expiry > ?");
    $stmt->execute([$token, time()]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['last_activity'] = time();
        header("Location: index.php");
        exit();
    }
}

require '../views/login.view.php';
?>
