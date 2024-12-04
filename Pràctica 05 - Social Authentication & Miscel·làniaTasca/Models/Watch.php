<?php
//Sumit Mahi
class Watch {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Per obtenir tots els rellotges
    public function getAllWatches($limit, $offset) {
        $stmt = $this->pdo->prepare('SELECT id, name, price, information, image, official_url FROM watches LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Per obtenir un rellotge per ID
    public function getWatchById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM watches WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Per afegir un rellotge a la base de dades
    public function insertWatch($name, $price, $information, $image, $official_url) {
        $stmt = $this->pdo->prepare('INSERT INTO watches (name, price, information, image, official_url) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$name, $price, $information, $image, $official_url]);
    }
    // Per actualitzar un rellotge
    public function updateWatch($id, $name, $price, $information, $image, $official_url) {
        $stmt = $this->pdo->prepare('UPDATE watches SET name = ?, price = ?, information = ?, image = ?, official_url = ? WHERE id = ?');
        return $stmt->execute([$name, $price, $information, $image, $official_url, $id]);
    }
    // Per esborrar un rellotge
    public function deleteWatch($id) {
        $stmt = $this->pdo->prepare('DELETE FROM watches WHERE id = ?');
        return $stmt->execute([$id]);
    }
    // Per obtenir el nombre total de rellotges
    public function getTotalWatches() {
        $stmt = $this->pdo->query('SELECT COUNT(*) FROM watches');
        return $stmt->fetchColumn();
    }
}
?>