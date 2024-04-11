<?php

class MessageController
{
    private MessageManager $messageManager;
    private BookController $bookController;
    private UserManager $userManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->bookController = new BookController();
        $this->userManager = new UserManager();
    }

    /**
     * Affiche la page messagerie.
     * @return void
     */
    public function showMessaging(): void
    {
        $this->bookController->checkIfUserIsConnected();

        // Trouver l'utilisateur dans la base de données
        $user = $this->userManager->findUser('id', $_SESSION['idUser']);

        $messages = [];

        // Si l'identifiant est défini dans l'URL, on affiche les messages entre l'utilisateur et l'interlocuteur. 
        if (isset($_GET['id'])) {

            $interlocutor = $this->userManager->findUser('id', $_GET['id']);

            if (!$interlocutor) {
                throw new Exception("L'utilisateur n'existe pas");
            }

            $conversation = new Conversation($user, $interlocutor);

            // Marquer les messages comme lus
            if ($conversation->getUnreadMessagesCount() > 0) {
                $this->messageManager->markMessagesAsRead($user->getId(), $interlocutor->getId());
            }

            $messages = array_reverse($conversation->getMessages());
        }   

        // Retrouver toutes les conversations de l'utilisateur
        $conversations = $this->getConversations($user->getId());

        // On calcule le nombre de messages non consultés
        $messaging = new MessageManager();
        $_SESSION['nbMessages'] = $messaging->getNbMessages($_SESSION['idUser']);

        $view = new View("Messagerie");
        $view->render("messaging", [
        'conversations' => $conversations,
        'messages' => $messages,
        'interlocutor' => $interlocutor ?? null
        ]);
    }

    /**
     * Conversations de l'utilisateur
     * @param int $userId : id de l'utilisateur
     * @return array : Tableau d’objets Conversation.
     */
    public function getConversations(int $userId) : array
    {
        // Rechercher l'utilisateur dans la base de données
        $userManager = new UserManager();
        $user = $userManager->findUser('id', $userId);

        // Recherche tous les interlocuteurs
        $interlocutors = $this->messageManager->getAllInterlocutors($userId);

        // Créer une conversation pour chaque interlocuteur
        $conversations = [];
        foreach ($interlocutors as $interlocutor) {
            $conversations[] = new Conversation($user, $interlocutor);
        }

        return $conversations;    
    }

    /**
     * envoyer un message
     */
    public function sendMessage(): void
    {
        // Si l'utilisateur n'est pas connecté, nous le redirigeons vers la page de connexion
        $this->bookController->checkIfUserIsConnected();

        // Si le formulaire n'est pas vide
        if (!Empty($_POST)) {
            $message = new Message([
            'sender' => $_SESSION['idUser'],
            'receiver' => $_POST['receiver'],
            'content' => $_POST['content'],
            ]);

            $this->messageManager->sendMessage($message);
        }

        // Redirection vers la page de conversation
        Utils::redirect('messaging&id=' . $_POST['receiver']);
    }
}