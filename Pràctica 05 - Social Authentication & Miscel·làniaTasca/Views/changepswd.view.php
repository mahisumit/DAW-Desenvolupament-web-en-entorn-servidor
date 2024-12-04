<!DOCTYPE html>
<!--Sumit Mahi --> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../views/estils/styles.css">
    <link rel="stylesheet" href="../views/estils/changepswd.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Change Password</h1>
        <form method="POST" action="changepswd.php">
            <div class="input-container">
                <i class="fas fa-envelope icon"></i>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <?php if (!empty($email_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($email_error); ?></p>
            <?php endif; ?>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
            </div>
            <?php if (!empty($current_password_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($current_password_error); ?></p>
            <?php endif; ?>
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
            <?php if (!empty($password_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($password_error); ?></p>
            <?php endif; ?>
            <?php if (!empty($confirm_password_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($confirm_password_error); ?></p>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>
            <button type="submit">Change Password</button>
        </form>
        <a href="login.php">Back to Login</a>
    </div>
</body>
</html>