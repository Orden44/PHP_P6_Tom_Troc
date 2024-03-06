<?php

/**
 * Classe qui gère les livres.
 */
class BookManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les livres
     * @return array : un tableau d'objets livres.
     */
    public function getAllBooks() : array
    {
        $sql = "SELECT book.id, book.title, book.author, book.picture, book.content, user.pseudo as owner, book.available 
        FROM book INNER JOIN user ON book.id_user = user.id";
        $result = $this->db->query($sql);
        $books = [];
        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère les 4 derniers livres.
     * @return array : un tableau d'objets livres.
     */
    public function lastBooks() : array
    {
        $sql = "SELECT book.id, book.title, book.author, book.picture, book.content, user.pseudo as owner, book.available 
        FROM book INNER JOIN user ON book.id_user = user.id GROUP BY id DESC LIMIT 4";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère un livre par son id.
     * @param int $id : l'id du livre.
     * @return Book|null : un objet Book ou null si le livre n'existe pas.
     */
    public function getBookById(int $id) : ?Book
    {
        $sql = "SELECT book.id, book.title, book.author, book.picture, book.content, user.pseudo as owner, book.available 
        FROM book INNER JOIN user ON book.id_user = user.id WHERE book.id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }
}