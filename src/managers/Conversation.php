<?php

class Conversation
{
    private User $user1;
    private User $user2;
    private array $messages = [];

    public function __construct($user1, $user2) {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->loadMessages();
    }

    /**
    * Messages entre les deux utilisateurs et triés par date.
    */
    public function loadMessages()
    {
        $messageManager = new MessageManager();
        $messages = $messageManager->getMessagesUsers($this->user1->getId(), $this->user2->getId());

        $this->messages = $messages;
    }

    /**
     * Getter pour les messages.
     */
    public function getMessages() : array
    {
        return $this->messages;
    }

    /**
     * Get le dernier message de la conversation.
     */
    public function getLastMessage() : Message|null
    {
        if (empty($this->messages)) {
            return null;
        }

        return $this->messages[0];
    }
 
    /**
     * Get l'interlocuteur de l'utilisateur connecté.
     * @return User
     */
    public function getInterlocutor() : User
    {
        $bookController = new BookController();
        $bookController->checkIfUserIsConnected();

        $userManager = new UserManager();

        $interlocutor = $this->user1->getId() === $_SESSION['idUser'] ? $this->user2 : $this->user1;

        return $interlocutor;
    }

    /**
     * Nombre de messages non lus de l'utilisateur connecté dans la conversation en cours.
     * @return int
     */
    public function getUnreadMessagesCount() : int
    {
        $unreadMessages = array_filter($this->messages, function($message) {

            return $message->getReceiver() === $_SESSION['idUser'] && !$message->getConsulted();
        });

        $unreadMessagesCount = count($unreadMessages);

        return $unreadMessagesCount;
    }  
}