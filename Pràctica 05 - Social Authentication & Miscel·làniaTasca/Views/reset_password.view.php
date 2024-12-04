<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../Views/estils/styles.css">
    <link rel="stylesheet" href="../Views/estils/reset_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>
        <form method="POST" action="../controllers/reset_password.php">
            <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? htmlspecialchars($_GET['token']) : ''; ?>">
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
            </div>
            <?php if (!empty($new_password_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($new_password_error); ?></p>
            <?php endif; ?>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
            </div>
            <?php if (!empty($confirm_password_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($confirm_password_error); ?></p>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>
            <button type="submit">Reset Password</button>
        </form>
        <a href="../Views/login.view.php">Back to Login</a>
    </div>
</body>
</html>