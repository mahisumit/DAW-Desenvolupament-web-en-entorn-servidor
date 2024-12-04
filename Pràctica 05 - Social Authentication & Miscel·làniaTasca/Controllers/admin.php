<?php
//Sumit Mahi
session_start();
require_once '../config.php';  

// per comprobar si l'usuari és un administrador
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

// Fetch tots els usuaris 
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();

require '../views/admin.view.php';
?>