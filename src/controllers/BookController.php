<?php 

class BookController 
{
    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $this->checkIfUserIsConnected();

        $bookManager = new BookManager();
        $books = $bookManager->lastBooks();
        
        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }

    /**
     * Affiche la page des livres.
     * @return void
     */
    public function showAllBooks() : void
    {
        $this->checkIfUserIsConnected();

        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();
        $view = new View("Livres");
        $view->render("books", ['books' => $books]);
    }

    /**
     * Affiche le détail d'un livre.
     * @param int $id
     * @return void
     */
    public function showBook($id) : void
    {
        $this->checkIfUserIsConnected();

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);        
        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }
        $view = new View($book->getTitle());
        $view->render("detailBook", ['book' => $book]);
    }

    public function editBook($id): void
    {
        $this->checkIfUserIsConnected();

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }
        $view = new View($book->getTitle());
        $view->render('editBook', ['book' => $book]);
    }
}