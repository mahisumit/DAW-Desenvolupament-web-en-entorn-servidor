<?php
session_start();
include '../controllers/BookController.php';
include '../public/functions.php';

// Comprova si l'usuari està autenticat
if (!isset($_SESSION['user_id'])) {
    setFlashMessage('error', 'Has d\'estar registrat per editar un llibre.');
    header("Location: ../views/login.view.php");
    exit;
}

$controller = new BookController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author_id = $_POST['author_id'];
    $publication_year = $_POST['publication_year'];

    $result = $controller->updateBook($bookId, $title, $author_id, $publication_year, $description, null);

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
    $bookId = $_GET['id'];
    $book = $controller->getBookById($bookId);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edita Llibre</title>
    <link rel="stylesheet" type="text/css" href="../public/Estils/styles.css">
    <link rel="stylesheet" type="text/css" href="../public/Estils/edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="content">
        <h1>Edita Llibre</h1>
        <?php displayFlashMessages(); ?>
        <form method="POST" action="../views/edit.view.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
            <div class="form-group">
                <label for="title"><i class="fas fa-book"></i> Títol:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Descripció:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($book['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="author_id"><i class="fas fa-user"></i> Autor ID:</label>
                <input type="text" id="author_id" name="author_id" value="<?php echo htmlspecialchars($book['author_id']); ?>" required>
            </div>
            <div class="form-group">
                <label for="publication_year"><i class="fas fa-calendar-alt"></i> Any de publicació:</label>
                <input type="text" id="publication_year" name="publication_year" value="<?php echo htmlspecialchars($book['publication_year']); ?>" required>
            </div>
            <button type="submit" class="edit-button"><i class="fas fa-save"></i> Actualitza</button>
        </form>
    </div>
</body>
</html>