<!-- @author Sumit Mahi -->
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="../public/estils/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function validateForm(event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var errorMessage = document.getElementById("error-message");

            if (password !== confirmPassword) {
                errorMessage.textContent = "Passwords do not match.";
                event.preventDefault(); 
            } else {
                errorMessage.textContent = ""; 
            }
        }
    </script>
</head>
<body>
    <?php require_once '../public/functions.php'; displayFlashMessages(); ?>
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
        <h2>Signup</h2>
        <form method="POST" action="../public/signup.php" onsubmit="validateForm(event)">
            <div id="error-message" style="color: red; margin-bottom: 10px;"></div>
            <div class="input-container">
                <i class="fas fa-user icon"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <i class="fas fa-envelope icon"></i>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <button type="submit">Signup</button>
        </form>
        <p>Already have an account? <a href="../views/login.view.php">Login</a></p>
    </div>
</body>
</html>