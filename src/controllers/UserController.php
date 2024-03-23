<?php

class UserController
{
    /**
     * Affiche la page mon compte.
     * @return void
     */
    public function showProfile(): void
    {
        // On connecte l'utilisateur.
        $user = unserialize($_SESSION['user']);

        if (!$user) {
            throw new Exception("L'utilisateur n'existe pas.");
        }

        // Récupére les livres de l'utilisateur
        $bookManager = new BookManager();
        $books = $bookManager->getBookById(null, $user->getId());        
            
        $view = new View('ShowProfile');
        $view->render('profile', ['user' => $user, 'books' => $books]);
    }
        
    /**
    * Traite le formulaire depuis la page de profil 
    * pour modifier les informations de l'utilisateur
    */
    public function modifyUserInfo()
    { 
        // // Trouver l'utilisateur par l'id
        $id = $_SESSION['idUser'];

        $userManager = new UserManager();
        $user = $userManager->findUser('id', $id) ?? null;

        $pseudo = Utils::request("pseudo");
        $password = Utils::request("password");
        $mail = Utils::request("mail");

        // On crée l'objet utilisateur.
        $user = new User([
        'id' => $id, 
        'pseudo' => $pseudo,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'mail' => $mail,
        'picture' => $user->getPicture()
        ]);

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($mail) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // Traiter la photo de profil
        $picErrors = $user->setImageFromForm('picture', 'public/img/userpics/');

        // Mettre à jour l'utilisateur dans la base de données
        $userManager->updateUser($user);

        // Récupére les livres de l'utilisateur
        $bookManager = new BookManager();
        $books = $bookManager->getBookById(null, $user->getId());        

        if ($user) {
            unset($_SESSION['user']); 
            Utils::redirect("home");
        } 

        // Restituer la vue
        $view = new View('ShowProfile');
        $view->render('profile', ['user' => $user, 'books' => $books, 'picErrors' => $picErrors]);
    }
}