<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="../public/Estils/change-psw.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function validateForm(event) {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var errorMessage = document.getElementById("error-message");

            if (newPassword !== confirmPassword) {
                errorMessage.textContent = "Les contrasenyes no coincideixen.";
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
    </div>
    <div class="login-container">
        <h2>Change Password</h2>
        <form method="POST" action="../public/change-psw.php" onsubmit="validateForm(event)">
            <div id="error-message" style="color: red; margin-bottom: 10px;"></div>
            <div class="input-container">
                <i class="fas fa-user icon"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="old_password" name="old_password" placeholder="Old Password" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
            </div>
            <button type="submit" class="change-psw-button">Change Password</button>
        </form>
    </div>
</body>
</html>