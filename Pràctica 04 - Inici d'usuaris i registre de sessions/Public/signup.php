<?php
// @autor Sumit Mahi
session_start();
include '../controllers/UserController.php';
include '../public/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Comprova si les contrasenyes coincideixen
    if ($password !== $confirm_password) {
        setFlashMessage('error', 'Les contrasenyes no coincideixen.');
        header("Location: ../views/signup.view.php");
        exit;
    }

    $controller = new UserController();
    $result = $controller->signup($username, $email, $password, $confirm_password);

    // Comprova si el registre ha estat exitós
    if ($result) {
        setFlashMessage('success', 'T\'has registrat amb èxit!');
        header("Location: ../views/login.view.php");
        exit;
    } else {
        setFlashMessage('error', 'El registre ha fallat. El nom d\'usuari o el correu electrònic ja existeixen.');
        header("Location: ../views/signup.view.php");
        exit;
    }
} else {
    include '../views/signup.view.php';
}
?>