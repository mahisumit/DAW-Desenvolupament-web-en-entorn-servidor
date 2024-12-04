<!DOCTYPE html>
<!--Sumit Mahi --> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Watch</title>
    <link rel="stylesheet" href="../views/estils/styls.css">
    <link rel="stylesheet" href="../views/estils/edit.css">
    <style>
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Watch</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="edit.php?id=<?php echo htmlspecialchars($watch['id']); ?>" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($watch['name']); ?>" required>
            <br>
            <label for="price">Price (€):</label>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars(number_format($watch['price'], 2, ',', '.')); ?>" required>
            <br>
            <label for="information">Information:</label>
            <textarea id="information" name="information" required><?php echo htmlspecialchars($watch['information']); ?></textarea>
            <br>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            <br>
            <label for="official_url">Official URL:</label>
            <input type="text" id="official_url" name="official_url" value="<?php echo htmlspecialchars($watch['official_url']); ?>" required>
            <br>
            <button type="submit">Update</button>
        </form>
        <a class="back-link" href="index.php">Back to Watches</a>
    </div>
</body>
</html>