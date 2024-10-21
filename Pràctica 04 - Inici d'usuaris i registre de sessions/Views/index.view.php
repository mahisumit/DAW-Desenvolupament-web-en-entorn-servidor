<?php
session_start();
include '../controllers/BookController.php';
include '../public/functions.php';

$controller = new BookController();
$page = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$booksPerPage = 6;
$books = $controller->getBooksByPage($page, $booksPerPage);
$totalBooks = $controller->getTotalBooks();
$totalPages = ceil($totalBooks / $booksPerPage);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Llibres</title>
    <link rel="stylesheet" type="text/css" href="../public/Estils/styles.css">
</head>
<body>
    <div class="shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="navbar">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Welcome, <?php echo $_SESSION['username']; ?>!</span>
            <a href="../public/logout.php">Logout</a>
        <?php else: ?>
            <a href="../public/login.php">Login</a>
            <a href="../public/signup.php">Signup</a>
        <?php endif; ?>
    </div>
    <div class="content">
        <h1>Llibres</h1>
        <?php displayFlashMessages(); ?>
        <div class="books">
            <?php foreach ($books as $book): ?>
                <div class="book">
                    <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                    <p><?php echo htmlspecialchars($book['description']); ?></p>
                    <p>Autor ID: <?php echo htmlspecialchars($book['author_id']); ?></p>
                    <p>Any de publicació: <?php echo htmlspecialchars($book['publication_year']); ?></p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="../views/edit.view.php?id=<?php echo $book['id']; ?>" class="edit-button">Edit</a>
                        <a href="../public/delete.php?id=<?php echo $book['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?pagina=<?php echo $page - 1; ?>">&laquo; Pàgina anterior</a>
            <?php endif; ?>
            <span>Pàgina <?php echo $page; ?> de <?php echo $totalPages; ?></span>
            <?php if ($page < $totalPages): ?>
                <a href="?pagina=<?php echo $page + 1; ?>">Pàgina següent &raquo;</a>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="../views/insert.view.php" class="insert-button">Inserir Nou Llibre</a>
        <?php endif; ?>
    </div>
</body>
</html>