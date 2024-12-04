<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../views/estils/styles.css">
    <link rel="stylesheet" href="../views/estils/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Update Profile</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required>
            </div>
            <div class="input-container">
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar" accept="image/*">
            </div>
            <div class="avatar-container"> <!-- Display current avatar -->
                <span class="username"><?php echo htmlspecialchars($user['username'] ?? ''); ?></span>
                <?php if (!empty($user['avatar'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['avatar']); ?>" alt="Current Avatar" class="avatar">
                <?php else: ?>
                    <i class="fas fa-user-circle default-avatar"></i>
                <?php endif; ?>
            </div>
            <button type="submit">Update Profile</button>
        </form>
        <a href="index.php" class="back-to-main">Back to Main Page</a>
    </div>
</body>
</html>