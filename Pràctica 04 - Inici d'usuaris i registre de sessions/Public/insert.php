<?php
// @autor Sumit Mahi
session_start();
include '../controllers/BookController.php';
include '../public/functions.php';

// Comprova si l'usuari està autenticat
if (!isset($_SESSION['user_id'])) {
    setFlashMessage('error', 'Has d\'estar registrat per inserir un llibre.');
    header("Location: ../views/login.view.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obté les dades del formulari
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $publication_year = $_POST['publication_year'];
    $description = $_POST['description'];

    $controller = new BookController();
    // Intenta crear el llibre
    $result = $controller->createBook($title, $author_id, $publication_year, $description);

    // Comprova si la creació del llibre ha estat exitosa
    if ($result) {
        setFlashMessage('success', 'Llibre inserit amb èxit!');
        header("Location: ../views/index.view.php");
        exit;
    } else {
        setFlashMessage('error', 'No s\'ha pogut inserir el llibre. Assegura\'t que l\'ID de l\'autor existeix.');
        header("Location: ../views/insert.view.php");
        exit;
    }
} else {
    // Redirigeix a la pàgina principal
    header("Location: ../views/index.view.php");
    exit;
}
?>