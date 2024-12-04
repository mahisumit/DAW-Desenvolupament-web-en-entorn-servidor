<?php
//Sumit Mahi
session_start();

// Estableix cookie de mida de lletra
setcookie('font-size', '30px', time() + 60 * 60 * 24 * 30, '/');

// Per comprovar si s'ha establert una mida de lletra
if (isset($_COOKIE['font-size'])) {
    $mida = $_COOKIE['font-size'];
} else {
    $mida = '8px';
}

require '../config.php';
require '../models/User.php';
require '../models/Watch.php';
require '../controllers/AuthController.php';
require '../controllers/WatchController.php';

$authController = new AuthController($pdo);
$watchController = new WatchController($pdo);
$watches = $watchController->getAllWatches();

// 
$limit = 6; // límit de rellotges que es mostren en una pàgina
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

try {
    $watches = $watchController->watchModel->getAllWatches($limit, $offset);
    $totalWatches = $watchController->watchModel->getTotalWatches();
    $totalPages = ceil($totalWatches / $limit);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}

require '../views/index.view.php';
?>