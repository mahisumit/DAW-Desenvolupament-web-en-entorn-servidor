<?php
// @autor Sumit Mahi
include '../config.php';

class Book {
    private $db;

    // Constructor per inicialitzar la connexió a la base de dades
    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }

    // Obté tots els llibres
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obté un llibre per ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualitza un llibre existent
    public function update($id, $title, $author_id, $publication_year, $description) {
        $stmt = $this->db->prepare("UPDATE books SET title = :title, author_id = :author_id, publication_year = :publication_year, description = :description WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':publication_year', $publication_year);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    // Crea un nou llibre
    public function create($title, $author_id, $publication_year, $description) {
        $stmt = $this->db->prepare("INSERT INTO books (title, author_id, publication_year, description) VALUES (:title, :author_id, :publication_year, :description)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':publication_year', $publication_year);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    // Elimina un llibre per ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Obté llibres amb paginació
    public function getByPage($page, $booksPerPage) {
        $offset = ($page - 1) * $booksPerPage;
        $stmt = $this->db->prepare("SELECT * FROM books LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $booksPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obté el nombre total de llibres
    public function getTotalCount() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM books");
        return $stmt->fetchColumn();
    }
}
?>