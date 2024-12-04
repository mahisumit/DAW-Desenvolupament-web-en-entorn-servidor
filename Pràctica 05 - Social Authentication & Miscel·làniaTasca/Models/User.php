<?php
//Sumit Mahi
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Aquesta funció registra un nou usuari a la base de dades amb les dades proporcionades.
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        return $stmt->execute([$username, $email, $hashedPassword]);
    }
    // Aquesta funció comprova si les credencials proporcionades són correctes i retorna l'usuari si ho són.
    public function login($username, $password) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    // Aquesta funció comprova si un nom d'usuari ja existeix a la base de dades.
    public function usernameExists($username) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
    // Aquesta funció comprova si un correu electrònic ja existeix a la base de dades.
    public function emailExists($email) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
    // Aquesta funció retorna un usuari per ID.
    public function getUserById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>