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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $information = $_POST['information'];
    $official_url = $_POST['official_url'];

    // Per comprovar la imatge
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
        
            $image = file_get_contents($fileTmpPath);
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
            header('Location: insert.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "There was an error uploading the file.";
        header('Location: insert.php');
        exit();
    }

    // Insertar el rellotge
    $watchController->insert($name, $price, $information, $image, $official_url);
    $_SESSION['message'] = "Watch inserted successfully!";
    header('Location: insert.php');
    exit();
}

require '../views/insert.view.php';
?>