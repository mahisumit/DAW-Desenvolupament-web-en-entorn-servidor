<?php
// @autor Sumit Mahi
class User {
    private $pdo;

    public function __construct() {     // Inicialitzar la connexió a la base de dades
        global $pdo;
        $this->pdo = $pdo;
    }

    // Inicia sessió d'un usuari
    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Registra un nou usuari
    public function signup($username, $email, $password) {
        // Comprova si el nom d'usuari o el correu electrònic ja existeixen
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return false; // El nom d'usuari o el correu electrònic ja existeixen
        }

        // Per encriptar la contrasenya
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Per inserir un nou usuari
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    // Canvia la contrasenya d'un usuari
    public function changePassword($username, $oldPassword, $newPassword) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($oldPassword, $user['password'])) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
            return $stmt->execute([$hashedNewPassword, $username]);
        }
        return false;
    }
}
?>