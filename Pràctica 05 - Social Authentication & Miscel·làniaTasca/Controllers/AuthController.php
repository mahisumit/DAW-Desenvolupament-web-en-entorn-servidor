<?php
//Sumit Mahi
include_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login() { //Gestiona l'inici de sessió de l'usuari validant les credencials i establint variables de sessió si té èxit, o mostrant un missatge d'error si no.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->login($username, $password);
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['timeout'] = time();
                $_SESSION['message'] = 'Login successful!';
                header('Location: index.php');
                exit();
            } else {
                $error = 'Invalid username or password';
            }
        }
        include '../views/login.view.php';
    }

    public function register() { //Gestiona el registre de l'usuari validant les dades d'entrada i afegint un nou registre a la base de dades si tot és correcte.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Comprova si les contrasenyes coincideixen
            if ($password !== $confirmPassword) {
                $error = 'Passwords do not match';
                include '../views/signup.view.php';
                return;
            }

            // Per comprovar si l'usuari ja existeix
            if ($this->userModel->usernameExists($username)) {
                $error = 'Username already exists';
                include '../views/signup.view.php';
                return;
            }

            // Per comprovar si l'email ja existeix
            if ($this->userModel->emailExists($email)) {
                $error = 'Email already exists';
                include '../views/signup.view.php';
                return;
            }
            // Registra l'usuari
            if ($this->userModel->register($username, $email, $password)) {
                $_SESSION['message'] = 'Registration successful!';
                header('Location: login.php');
                exit();
            } else {
                $error = 'Registration failed';
            }
        }
        include '../views/signup.view.php';
    }
    // Per tancar la sessió de l'usuari i redirigir-lo a la pàgina d'inici.
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>