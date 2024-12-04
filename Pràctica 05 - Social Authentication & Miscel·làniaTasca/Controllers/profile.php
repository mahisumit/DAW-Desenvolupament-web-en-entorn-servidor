<?php
// Sumit Mahi
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../controllers/WatchController.php';

$watchController = new WatchController($pdo);

// Fetch els detalls de l'usuari actual
$user = $watchController->getUserById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? $user['username'];
    $avatar = $user['avatar']; // Default avatar

    // Comprova si s'ha pujat una nova imatge d'avatar
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        $fileSize = $_FILES['avatar']['size'];
        $fileType = $_FILES['avatar']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Comprova si l'extensió del fitxer és vàlida
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $avatar = file_get_contents($fileTmpPath);
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
            header('Location: profile.php');
            exit();
        }
    }

    // Actualitza el perfil de l'usuari
    $watchController->updateProfile($username, $avatar);
    $_SESSION['message'] = "Profile updated successfully!";
    header('Location: profile.php');
    exit();
}

require '../views/profile.view.php';
?>