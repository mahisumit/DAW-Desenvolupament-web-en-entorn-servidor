<!-- @author Sumit Mahi -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../public/estils/login.css">
    <link rel="stylesheet" type="text/css" href="../public/estils/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        session_start(); 
        require_once '../public/functions.php';
        displayFlashMessages();
        ?>
        <form method="POST" action="../public/login.php">
            <div class="input-container">
                <i class="fas fa-user icon"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="../views/signup.view.php">Sign up</a></p>
        <p>Forgot your password? <a href="../views/change-psw.view.php">Change Password</a></p>
    </div>
</body>
</html>