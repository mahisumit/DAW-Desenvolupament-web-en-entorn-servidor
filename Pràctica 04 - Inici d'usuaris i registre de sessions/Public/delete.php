<?php
session_start();
include '../controllers/BookController.php';
include '../public/functions.php';

// Comprova si l'usuari està autenticat
if (!isset($_SESSION['user_id'])) {
    setFlashMessage('error', 'Has d\'estar registrat per eliminar un llibre.');
    header("Location: ../views/login.view.php");
    exit;
}

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];
    $controller = new BookController();
    $result = $controller->deleteBook($bookId);

    if ($result) {
        setFlashMessage('success', 'Llibre eliminat amb èxit!');
    } else {
        setFlashMessage('error', 'No s\'ha pogut eliminar el llibre. Torna-ho a provar.');
    }
    header("Location: ../views/index.view.php");
    exit;
} else {
    header("Location: ../views/index.view.php");
    exit;
}
?>