<?php
//Sumit Mahi
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../controllers/WatchController.php';

$watchController = new WatchController($pdo);

// Fetch the watch details
$watch_id = $_GET['id'];
$watch = $watchController->getWatchById($watch_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $information = $_POST['information'];
    $official_url = $_POST['official_url'];

    // per comprovar si s'ha enviat una imatge
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Verificar si el archivo tiene una de las extensiones permitidas
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Read the file
            $image = file_get_contents($fileTmpPath);
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
            header('Location: edit.php?id=' . $watch_id);
            exit();
        }
    } else {
        $image = $watch['image_upload']; // Conservar la imagen existente si no se carga ninguna imagen nueva
    }

    // Actualitzar el rellotge
    $watchController->update($watch_id, $name, $price, $information, $image, $official_url);
    $_SESSION['message'] = "Watch updated successfully!";
    header('Location: edit.php?id=' . $watch_id);
    exit();
}

require '../views/edit.view.php';
?>