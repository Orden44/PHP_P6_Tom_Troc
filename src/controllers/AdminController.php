<?php 

class AdminController 
{
    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm() : void 
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Affichage du formulaire d'inscription.
     * @return void
     */
    public function displaySignup() : void 
    {
        $view = new View("Identification");
        $view->render("signupForm");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser() : void 
    {
        // On récupère les données du formulaire.
        $mail = Utils::request("mail");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($mail) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->findUser('mail', $mail);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = serialize($user);
        $_SESSION['idUser'] = $user->getId();

        // On calcule le nombre de messages non consultés
        $messaging = new MessageManager();
        $_SESSION['nbMessages'] = $messaging->getNbMessages($user->getId());

        // On redirige vers la page d'acceuil.
        Utils::redirect("home");
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser() : void 
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }
    
    /**
     * Inscription de l'utilisateur.
     */
    public function registerUser() 
    {      
        // On récupère les données du formulaire.
        $pseudo = Utils::request("pseudo");
        $mail = Utils::request("mail");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($mail) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que le nom de l'utilisateur n'existe pas.
        $userManager = new UserManager();
        $user = $userManager->findUser('pseudo', $pseudo);
        if ($user) {
            throw new Exception("Un compte existe déjà.");
        }
        
        // On vérifie que le mail n'existe pas.
        $user = $userManager->findUser('mail', $mail);
        if ($user) {
            throw new Exception("Un compte existe déjà.");
        }    
        
        //On vérifie que le mail soit valide.
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Entrez un mail valide.");
        }      

        // On crée l'objet User.
        $user = new User([
            'pseudo' => htmlspecialchars($pseudo),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'mail' => htmlspecialchars($mail)
        ]);

        // On ajoute l'utilisateur.
        $result = $userManager->addUser($user);

        // On vérifie que l'ajout a bien fonctionné.
        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout de l'utilisateur.");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = serialize($user);
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }
}