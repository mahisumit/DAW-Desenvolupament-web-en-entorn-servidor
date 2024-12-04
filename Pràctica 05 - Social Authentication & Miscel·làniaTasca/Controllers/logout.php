<?php
// Sumit Mahi
session_start();
require_once '../config.php';

// Invalidate the "Remember Me" token in the database
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL, remember_token_expiry = NULL WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

// Destroy the session
session_destroy();

// Clear the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Esborra cookie "Recorda'm".
setcookie('remember_me', '', time() - 3600, "/");

// Redirect to the login page
header('Location: login.php');
exit();
?>
