<?php
require_once '../config.php';

class User {
    private $db;

    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }

    // Inicia sessió d'un usuari
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
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
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return false; // El nom d'usuari o el correu electrònic ja existeixen
        }

        // Per encriptar la contrasenya
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Per inserir un nou usuari
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    // Canvia la contrasenya d'un usuari
    public function changePassword($username, $oldPassword, $newPassword) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($oldPassword, $user['password'])) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE username = ?");
            return $stmt->execute([$hashedNewPassword, $username]);
        }
        return false;
    }

    // Obté un usuari pel seu nom d'usuari
    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualitza la contrasenya d'un usuari
    public function updatePassword($username, $hashedPassword) {
        $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }
}
?>