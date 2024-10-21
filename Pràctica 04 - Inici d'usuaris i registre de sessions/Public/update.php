<?php
// @autor Sumit Mahi
session_start();
include '../controllers/BookController.php';
include '../public/functions.php';

if (!isset($_SESSION['user_id'])) {
    setFlashMessage('error', 'Has d\'estar registrat per actualitzar un llibre.');
    header("Location: ../views/login.view.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author_id = $_POST['author_id']; 
    $publication_year = $_POST['publication_year']; 

    $controller = new BookController();
    $result = $controller->updateBook($bookId, $title, $author_id, $publication_year, $description);
    // Per actualitzar els llibres
    // Comprova si l'actualització del llibre ha estat exitosa
    if ($result) {
        setFlashMessage('success', 'Llibre actualitzat amb èxit!');
        header("Location: ../views/index.view.php");
        exit;
    } else {
        setFlashMessage('error', 'No s\'ha pogut actualitzar el llibre. Torna-ho a provar.');
        header("Location: ../views/edit.view.php?id=$bookId");
        exit;
    }
} else {
    header("Location: ../views/index.view.php");
    exit;
}
?>