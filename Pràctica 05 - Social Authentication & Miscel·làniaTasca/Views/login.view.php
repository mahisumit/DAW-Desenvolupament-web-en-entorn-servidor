<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../views/estils/login.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['message']); ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="input-container">
                <label for="login">Email or Username</label>
                <input type="text" id="login" name="login" placeholder="Enter your email or username" required>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="input-container">
                <input type="checkbox" id="remember_me" name="remember_me">
                <label for="remember_me">Remember Me</label>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="signup.php" class="back-to-main">Sign Up</a>
        <a href="recover_password.php">Forgot Password?</a>
    </div>
</body>
</html>