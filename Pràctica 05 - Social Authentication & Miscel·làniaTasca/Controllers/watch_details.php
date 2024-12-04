<?php
//Sumit Mahi
require_once '../config.php';

if (!isset($_GET['id'])) {
    die("Watch ID not specified.");
}

$id = intval($_GET['id']);

try {
    $stmt = $pdo->prepare('SELECT name, price, information, image, official_url FROM watches WHERE id = ?');
    $stmt->execute([$id]);
    $watch = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$watch) {
        die("Watch not found.");
    }
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}

require '../views/watch_details.view.php';
?>