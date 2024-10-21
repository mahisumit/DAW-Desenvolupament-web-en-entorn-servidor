<!-- @author Sumit Mahi -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Llibre</title>
</head>
<body>
    <h1>Eliminar Llibre</h1>
    <p>Esteu segur que voleu eliminar el llibre "<?php echo htmlspecialchars($book['title']); ?>"?</p>
    <form action="delete.php?id=<?php echo $book['id']; ?>" method="POST">
        <button type="submit">Sí, esborra</button>
        <a href="index.php">Cancel·la</a>
    </form>
</body>
</html>
