<?php
// @author Sumit Mahi
session_start();
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        setFlashMessage('error', 'Les noves contrasenyes no coincideixen.');
        header('Location: ../views/change-psw.view.php');
        exit();
    }

    $user = getUserById($user_id); 

    if (!password_verify($current_password, $user['password'])) {
        setFlashMessage('error', 'La contrasenya actual és incorrecta.');
        header('Location: ../views/change-psw.view.php');
        exit();
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    if (updateUserPassword($user_id, $hashed_password)) { 
        setFlashMessage('success', 'Contrasenya canviada amb èxit.');
    } else {
        setFlashMessage('error', 'No s\'ha pogut canviar la contrasenya. Si us plau, torna-ho a intentar.');
    }

    header('Location: ../views/change-psw.view.php');
    exit();
}
?>