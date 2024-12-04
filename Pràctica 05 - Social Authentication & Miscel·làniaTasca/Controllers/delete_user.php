<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

// Comprova si l'usuari és un admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

// Comprova si s'ha enviat un ID d'usuari
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Elimina l'usuari de la base de dades
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);

    $_SESSION['message'] = "User deleted successfully!";
}

header("Location: admin.php");
exit();
?>