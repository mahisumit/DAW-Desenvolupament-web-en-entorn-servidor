<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

// Comprova si l'usuari ha iniciat sessió
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch els rellotges creats per l'usuari que ha iniciat sessió o tots els rellotges si l'usuari és un administrador
$user_id = $_SESSION['user_id'];
if ($_SESSION['is_admin']) {
    $stmt = $pdo->prepare("SELECT watches.*, users.username FROM watches JOIN users ON watches.created_by = users.id WHERE created_by = ?");
    $stmt->execute([$user_id]);
} else {
    $stmt = $pdo->prepare("SELECT watches.*, users.username FROM watches JOIN users ON watches.created_by = users.id WHERE created_by = ?");
    $stmt->execute([$user_id]);
}
$watches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Trunca un text determinat a un nombre especificat de línies. S'utilitza per limitar la quantitat de text que es mostra per a cada rellotge.
function truncateText($text, $lines = 2) {
    $linesArray = explode("\n", wordwrap($text, 100));
    return implode("\n", array_slice($linesArray, 0, $lines));
}

require '../views/my_watch.view.php';
?>