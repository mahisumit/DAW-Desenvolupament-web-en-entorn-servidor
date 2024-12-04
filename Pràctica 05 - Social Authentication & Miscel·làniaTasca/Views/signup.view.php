<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../views/estils/styles.css">
    <link rel="stylesheet" href="../views/estils/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form method="POST" action="signup.php">
            <div class="input-container">
                <i class="fas fa-user icon"></i>
                <input type="text" id="username" name="username" placeholder="Enter your username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
            </div>
            <?php if (!empty($username_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($username_error); ?></p>
            <?php endif; ?>
            <div class="input-container">
                <i class="fas fa-envelope icon"></i>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
            </div>
            <?php if (!empty($email_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($email_error); ?></p>
            <?php endif; ?>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
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
            <button type="submit">Sign Up</button>
        </form>
        <a href="login.php">Login</a>
    </div>
</body>
</html>