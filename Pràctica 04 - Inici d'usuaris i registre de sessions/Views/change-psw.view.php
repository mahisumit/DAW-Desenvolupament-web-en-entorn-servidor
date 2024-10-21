<!-- @author Sumit Mahi -->
<!DOCTYPE html>
<html>
<head>
    <title>Canvia la Contrasenya</title>
    <link rel="stylesheet" type="text/css" href="../public/estils/change-psw.css">
</head>
<body>
    <div class="container">
        <h2>Canvia la Contrasenya</h2>
        <?php
        session_start();
        include '../public/functions.php';
        displayFlashMessages();
        ?>
        <form method="POST" action="../public/change-psw.php">
            <div class="input-container">
                <label for="current_password">Contrasenya Actual</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="input-container">
                <label for="new_password">Nova Contrasenya</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="input-container">
                <label for="confirm_password">Confirma la Nova Contrasenya</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Canvia la contrasenya</button>
        </form>
    </div>
</body>
</html>