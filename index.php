<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');
$id = Utils::request('id');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
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
            $bookController->showBook($id);
            break;
        
        case 'showUpdateBookForm':
            $bookController = new BookController();
            $bookController->showUpdateBookForm($id);
            break;
        
        case 'updateBook':
            $bookController = new BookController();
            $bookController->updateBook($id);
            break;

        case 'deleteBook':
            $bookController = new BookController();
            $bookController->deleteBook($id);
            break;
                
        case 'messaging':
            $messageController = new MessageController();
            $messageController->showMessaging();
            break;

        case 'sendMessage':
            $messageController = new MessageController();
            $messageController->sendMessage();
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
        
        case 'profile': 
            $userController = new UserController();
            $userController->showProfile();
            break;
    
        case 'owner': 
            $userController = new UserController();
            $userController->showOwner();
            break;
    
        case 'modifyUserInfo':
            $userController = new UserController();
            $userController->modifyUserInfo();
            break;
      
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
