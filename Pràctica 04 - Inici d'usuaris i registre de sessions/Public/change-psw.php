<?php
session_start();
require_once '../models/User.php';
require_once '../public/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    $userModel = new User();
    $user = $userModel->getUserByUsername($username);

    // Verifica si l'usuari existeix i la contrasenya antiga és correcta
    if ($user && password_verify($oldPassword, $user['password'])) {
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $result = $userModel->updatePassword($username, $hashedNewPassword);

        // Comprova si la contrasenya s'ha actualitzat correctament
        if ($result) {
            setFlashMessage('success', 'Contrasenya canviada correctament!');
            header('Location: ../views/login.view.php');
            exit;
        } else {
            setFlashMessage('error', 'No s\'ha pogut canviar la contrasenya. Si us plau, torna-ho a intentar.');
        }
    } else {
        setFlashMessage('error', 'Nom d\'usuari o contrasenya antiga invàlids.');
    }
    header('Location: ../views/change-psw.view.php');
    exit;
}
?>