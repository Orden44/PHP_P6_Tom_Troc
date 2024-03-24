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
        
        while ($book = $result->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère les livres recherchés.
     * @return array : un tableau d'objets livres.
     */
    public function searchBooks(string $query) : ?array
    {
        $sql = "SELECT book.id, book.title, book.author, book.picture, book.content, user.pseudo as owner, book.available 
        FROM book INNER JOIN user ON book.id_user = user.id WHERE book.title LIKE ? OR book.author LIKE ?";
        $result = $this->db->query($sql, ["%$query%", "%$query%"]);
        $books = [];

        while ($book = $result->fetch(PDO::FETCH_ASSOC)) {
        $books[] = new Book($book);
        }
        return $books ? $books : null;
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

        while ($book = $result->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère un livre par son id ou l'id de l'utilisateur.
     * @param int|null $id : l'id du livre
     * @param int|null $userId : l'id de l'utilisateur
     * @return Book|null : un objet Book ou null si le livre n'existe pas.
     */
    public function getBookById(?int $id = null, ?int $userId = null) 
    {
        $sql = "SELECT book.id, book.title, book.author, book.picture, book.content, user.pseudo AS owner, user.picture AS userImage, book.available 
        FROM book INNER JOIN user ON book.id_user = user.id";

        if ($id !== null) {
            $sql .= " WHERE book.id = :id";
            $params = ["id" => $id];
            $stmt = $this->db->query($sql, $params);
            $stmt->execute($params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null; 
            }
            $book = new Book($result);
            return $book;
        } elseif ($userId !== null) {
            $sql .= " WHERE book.id_user = :userId ORDER BY book.id DESC";
            $params = ["userId" => $userId];          
            $stmt = $this->db->query($sql, $params);
            $stmt->execute(["userId" => $userId]);
            $books = [];

            while ($book = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $books[] = new Book($book);
            }
            return $books;
        } 
    }

    /**
     * Modifie un livre.
     * @param Book $book : le livre à modifier.
     * @return void
     */
    public function updateBook(Book $book) : void
    {
        if ($book->getPicture() == null && $book->getAvailable() == false) {
            $sql = "UPDATE book SET title = :title, author = :author, content = :content, available = :available WHERE id = :id";
            $this->db->query($sql, [
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'content' => $book->getContent(),
                'available' => 0,
                'id' => $book->getId()
            ]);
        } elseif ($book->getPicture() == null && $book->getAvailable() == true) {
            $sql = "UPDATE book SET title = :title, author = :author, content = :content, available = :available WHERE id = :id";
            $this->db->query($sql, [
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'content' => $book->getContent(),
                'available' => $book->getAvailable(),
                'id' => $book->getId()
            ]);
        } elseif ($book->getPicture() !== null && $book->getAvailable() == false) {
            $sql = "UPDATE book SET title = :title, author = :author, picture = :picture, content = :content, available = :available WHERE id = :id";
            $this->db->query($sql, [
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'picture' => $book->getPicture(),
                'content' => $book->getContent(),
                'available' => 0,
                'id' => $book->getId()
            ]);    
        } else {
            $sql = "UPDATE book SET title = :title, author = :author, picture = :picture, content = :content, available = :available WHERE id = :id";
            $this->db->query($sql, [
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'picture' => $book->getPicture(),
                'content' => $book->getContent(),
                'available' => $book->getAvailable(),
                'id' => $book->getId()
            ]);    
        }
    }

    /**
     * Supprime un livre.
     * @param int $id : l'id du livre à supprimer.
     * @return void
     */
    public function deleteBook(int $id) : void
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}