<?php
// @autor Sumit Mahi
session_start();
include '../controllers/UserController.php';
include '../public/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obté les dades del formulari
    $username = $_POST['username'];
    $password = $_POST['password'];

    $controller = new UserController();
    // Intenta iniciar sessió amb les credencials proporcionades
    $user = $controller->login($username, $password);

    // Comprova si l'inici de sessió ha estat exitós
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        setFlashMessage('success', 'Inici de sessió exitós!');
        // Redirigeix a la pàgina principal
        header("Location: ../views/index.view.php");
        exit;
    } else {
        // surts un missatge d'error si les credencials són incorrectes
        setFlashMessage('error', 'Credencials incorrectes. Torna-ho a provar.');
        header("Location: ../views/login.view.php");
        exit;
    }
} else {
    include '../views/login.view.php';
}
?>