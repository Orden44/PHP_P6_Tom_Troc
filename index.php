<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;

        case 'books':
            $bookController = new BookController();
            $bookController->showAllBooks();
            break;
        
        case 'showBook': 
            $bookController = new BookController();
            $bookController->showBook();
            break;

        case 'connectionForm':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;

        case 'signupForm': 
            $adminController = new AdminController();
            $adminController->displaySignup();
            break;
    
        case 'connectUser': 
            $adminController = new AdminController();
            $adminController->connectUser();
            break;

        case 'registerUser': 
            $adminController = new AdminController();
            $adminController->registerUser();
            break;
    
        case 'disconnectUser': 
            $adminController = new AdminController();
            $adminController->disconnectUser();
            break;
        
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
