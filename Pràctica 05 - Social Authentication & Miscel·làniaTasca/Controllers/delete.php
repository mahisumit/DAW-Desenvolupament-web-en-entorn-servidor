<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

// Comprova si l'usuari està logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the watch details
$watch_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM watches WHERE id = ?");
$stmt->execute([$watch_id]);
$watch = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'usuari està autoritzat a eliminar el rellotge
if (!$watch || (!$_SESSION['is_admin'] && $watch['created_by'] != $_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
    // Eliminar el rellotge 
    $stmt = $pdo->prepare("DELETE FROM watches WHERE id = ?");
    $stmt->execute([$watch_id]);

    $_SESSION['message'] = "Watch deleted successfully!";
    header("Location: index.php");
    exit();
}

require '../views/delete.view.php';
?>