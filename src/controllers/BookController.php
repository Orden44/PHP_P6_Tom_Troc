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
     * @return void
     */
    public function showBook() : void
    {
        $this->checkIfUserIsConnected();

        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        
        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }

        $view = new View($book->getTitle());
        $view->render("detailBook", ['book' => $book]);
    }
}