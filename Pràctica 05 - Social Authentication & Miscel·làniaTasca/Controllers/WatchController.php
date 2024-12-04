<?php
//Sumit Mahi
include_once __DIR__ . '/../models/Watch.php';

class WatchController {
    private $pdo;
    public $watchModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->watchModel = new Watch($pdo);
    }
    // Per afegir un rellotge a la base de dades
    public function insert($name, $price, $information, $image, $official_url) {
        $stmt = $this->pdo->prepare("INSERT INTO watches (name, price, information, image_upload, official_url, created_by) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $price);
        $stmt->bindParam(3, $information);
        $stmt->bindParam(4, $image, PDO::PARAM_LOB);
        $stmt->bindParam(5, $official_url);
        $stmt->bindParam(6, $_SESSION['user_id']);
        $stmt->execute();
    }
    // Per obtenir tots els rellotges
    public function getAllWatches() {
        $stmt = $this->pdo->prepare("SELECT watches.*, users.username FROM watches JOIN users ON watches.created_by = users.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     // Per obtenir un rellotge per ID
    public function getWatchById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM watches WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
     // Per actualitzar un rellotge
    public function update($id, $name, $price, $information, $image, $official_url) {
        $stmt = $this->pdo->prepare("UPDATE watches SET name = ?, price = ?, information = ?, image_upload = ?, official_url = ? WHERE id = ?");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $price);
        $stmt->bindParam(3, $information);
        $stmt->bindParam(4, $image, PDO::PARAM_LOB);
        $stmt->bindParam(5, $official_url);
        $stmt->bindParam(6, $id);
        $stmt->execute();
    }
    // Per esborrar un rellotge
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM watches WHERE id = ?");
        $stmt->execute([$id]);
    }
    // Per actualitzar perfil
    public function updateProfile($username, $avatar) {
        $sql = "UPDATE users SET username = :username, avatar = :avatar WHERE id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':avatar' => $avatar,
            ':user_id' => $_SESSION['user_id']
        ]);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>