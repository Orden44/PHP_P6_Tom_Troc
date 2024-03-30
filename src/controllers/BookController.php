<?php 

class BookController 
{
    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    public function checkIfUserIsConnected() : void
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

        // Si l'utilisateur a recherché un livre dans la barre de recherche, nous affichons les résultats
        // Sinon, nous affichons tous les livres
        if (isset($_POST['search']) && strlen($_POST['search']) >= 3) {
            $query = htmlspecialchars($_POST['search']);
            $books = $bookManager->searchBooks($query);
        } else {
            $books = $bookManager->getAllBooks();
        }

        $view = new View("Books");
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

    public function showUpdateBookForm($id): void
    {
        $this->checkIfUserIsConnected();

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }

        // Traiter la photo de profil
        $picErrors = $book->setImageFromForm('picture', 'public/img/books/');

        $view = new View("Modification d'un livre");
        $view->render("updateBookForm", ['book' => $book, 'picErrors' => $picErrors]);
    }

    /**
     * Mdification d'un livre. 
     * On sait si un livre est modifié car l'id vaut -1.
     * @param int $id
     * @return void
     */
    public function updateBook($id) : void 
    {
        $this->checkIfUserIsConnected();

        // On récupère les données du formulaire.
        $id = Utils::request("id", -1);
        $title = Utils::request("title");
        $author = Utils::request("author");
        $picture = Utils::request("picture");
        $content = Utils::request("content");
        $available = (Utils::request("available") == "false") ? 0 : 1;

        // On vérifie que les données sont valides.
        if (empty($title)) {
            throw new Exception("Le champ du titre est obligatoire.");
        }

        // On crée l'objet livre.
        $book = new Book([
            'id' => $id, // Si l'id vaut -1, le livre sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'author' => $author,
            'picture' => $picture,
            'content' => $content,
            'available' => $available,
            'id_user' => $_SESSION['idUser']
        ]);

        // Traiter la photo de profil
        $picErrors = $book->setImageFromForm('picture', 'public/img/books/');

        // Mise à jour du livre
        $bookManager = new BookManager();
        $bookManager->updateBook($book);

        // Si le formulaire est valide, redirigez vers la page de profil
        if (empty($picErrors)) {
            Utils::redirect("profile");
        }
      
        // Si le formulaire n'est pas valide, affichez les erreurs.
        $view = new View("Book");
        $view->render("updateBookForm", ['book' => $book, 'picErrors' => $picErrors]);
    }

    /**
     * Suppression d'un livre.
     * @param int $id
     * @return void
     */
    public function deleteBook($id) : void
    {
        $this->checkIfUserIsConnected();

        $id = Utils::request("id", -1);

        // On supprime le livre.
        $bookManager = new BookManager();
        $bookManager->deleteBook($id);
       
        // On redirige vers la page Mon compte.
        Utils::redirect("profile");
    }

}