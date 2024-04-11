<?php

/**
 * Classe qui gère les messages.
 */
class MessageManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les interlocuteurs
     * @param int $userId : id de l'utilisateur
     * @return array : un tableau d'objets interlocuteurs.
     */
    public function getAllInterlocutors(int $userId) : array
    {
        $sql = "SELECT * 
        FROM user 
        WHERE id IN (
            SELECT id_sending_user AS sender
            FROM messaging 
            WHERE id_receiving_user = :userId
            UNION 
            SELECT id_receiving_user AS receiver
            FROM messaging 
            WHERE id_sending_user = :userId
        )";    
    
        $result = $this->db->query($sql, ['userId' => $userId]);

        $interlocutors = [];
                
        while ($interlocutor = $result->fetch(PDO::FETCH_ASSOC)) {
            $interlocutors[] = new User($interlocutor);
        }

        return $interlocutors;
    }

    /**
     * Get messages entre utilisateurs.
     * @param int $userId : id de l'utilisateur.
     * @param int $interlocutorId : id de l'interlocuteur.
     * @return array : tableau d'objets message.
     */
    public function getMessagesUsers(int $userId, int $interlocutorId) : array
    {
        $sql = "SELECT id_sending_user AS sender, id_receiving_user AS receiver, content, date_creation, consulted
                FROM messaging 
                WHERE (id_sending_user = :userId AND id_receiving_user = :interlocutorId) 
                OR (id_sending_user = :interlocutorId AND id_receiving_user = :userId) 
                ORDER BY date_creation DESC";

        $result = $this->db->query($sql, ['userId' => $userId, 'interlocutorId' => $interlocutorId]);
        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }

        return $messages;
    }

    /**
     * Envoyer le message.
     * @param Message $message : le message à envoyer.
     */
    public function sendMessage(Message $message) : void
    {
        $sql = "INSERT INTO messaging (id_sending_user, id_receiving_user, content, date_creation) VALUES (:sender, :receiver, :content, NOW())";
        $this->db->query($sql, [
        'sender' => $message->getSender(),
        'receiver' => $message->getReceiver(),
        'content' => $message->getContent()
        ]);
    }

    /**
     * Marquer les messages comme lus.
     * @param int $userId : id de l'utilisateur.
     * @param int $interlocutorId : id de l'interlocuteur.
     */
    public function markMessagesAsRead(int $userId, int $interlocutorId) : void
    {
        $sql = "UPDATE messaging
                SET consulted = 1 
                WHERE id_receiving_user = :userId 
                AND id_sending_user = :interlocutorId";
        $this->db->query($sql, ['userId' => $userId, 'interlocutorId' => $interlocutorId]);
    }
 
    public function getNbMessages(int $userId) : int
    {
        $sql = "SELECT count(*) FROM `messaging` WHERE id_receiving_user = :userId AND consulted = 0";
        $result = $this->db->query($sql, ['userId' => $userId]);
        return $result->fetch()["count(*)"];
    }
}
