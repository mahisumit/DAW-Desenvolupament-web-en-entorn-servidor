<?php
// @author Sumit Mahi
include '../config.php';
include '../models/Book.php';

class BookController {
    // Obté tots els llibres
    public function getAllBooks() {
        $book = new Book();
        return $book->getAll();
    }

    // Obté un llibre per ID
    public function getBookById($id) {
        $book = new Book();
        return $book->getById($id);
    }

    // Crea un nou llibre
    public function createBook($title, $author_id, $publication_year, $description) {
        $book = new Book();
        try {
            return $book->create($title, $author_id, $publication_year, $description);
        } catch (Exception $e) {
            return false;
        }
    }

    // Actualitza un llibre existent
    public function updateBook($id, $title, $author_id, $publication_year, $description) {
        $book = new Book();
        return $book->update($id, $title, $author_id, $publication_year, $description);
    }

    // Elimina un llibre per ID
    public function deleteBook($id) {
        $book = new Book();
        return $book->delete($id);
    }

    // Obté llibres amb paginació
    public function getBooksByPage($page, $booksPerPage) {
        $book = new Book();
        return $book->getByPage($page, $booksPerPage);
    }

    // Obté el nombre total de llibres
    public function getTotalBooks() {
        $book = new Book();
        return $book->getTotalCount();
    }
}
?>