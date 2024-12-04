<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password</title>
    <link rel="stylesheet" href="../views/estils/styles.css">
    <link rel="stylesheet" href="../views/estils/recover_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Recover Password</h1>
        <form method="POST" action="recover_password.php">
            <div class="input-container">
                <i class="fas fa-envelope icon"></i>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <?php if (!empty($email_error)): ?>
                <p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($email_error); ?></p>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>
            <button type="submit">Request Password Reset</button>
        </form>
        <a href="login.php">Back to Login</a>
    </div>
</body>
</html>