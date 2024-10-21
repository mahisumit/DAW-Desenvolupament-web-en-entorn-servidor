<?php
// @author Sumit Mahi
session_start();
include '../controllers/BookController.php';
include '../public/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$controller = new BookController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $publication_year = $_POST['publication_year'];
    $description = $_POST['description'];

    $result = $controller->updateBook($id, $title, $author_id, $publication_year, $description);

    if ($result) {
        setFlashMessage('success', 'Llibre actualitzat amb èxit!');
    } else {
        setFlashMessage('error', 'No s\'ha pogut actualitzar el llibre.');
    }
    header("Location: index.php");
    exit;
} else {
    $book = $controller->getBookById($_GET['id']);
    include '../views/edit.view.php';
}
?>