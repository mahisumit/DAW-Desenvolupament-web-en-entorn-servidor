<!DOCTYPE html>
<!--Sumit Mahi --> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Watch</title>
    <link rel="stylesheet" href="../views/estils/delete.css">
</head>
<body>
    <div class="header">
        <h1>Delete Watch</h1>
    </div>
    <div class="confirmation">
        <p>Are you sure you want to delete this watch?</p>
        <form method="POST" action="delete.php?id=<?php echo htmlspecialchars($watch_id); ?>">
            <button type="submit" name="confirm">Yes, delete it</button>
            <a href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>