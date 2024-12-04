<?php
//Sumit Mahi
require_once '../config.php';
require_once '../controllers/AuthController.php';

$authController = new AuthController($pdo);
$authController->logout();
?>