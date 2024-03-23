<?php

/**
 * Entité représentant un message.
 * Avec les champs id, id_chats, content et date_creation.
 */
class Message extends AbstractEntity 
{
    private string $sender = "";
    private string $receiver = "";
    private string $content = "";
    private ?DateTime $dateCreation = null;
    
    /**
     * Setter pour l'id de l'expéditeur du message.
     * @param string $sender
     */
    public function setSender(string $sender) : void 
    {
        $this->sender = $sender;
    }

    /**
     * Getter pour l'id de l'expéditeur du message.
     * @return string
     */
    public function getSender() : string 
    {
        return $this->sender;
    }

        /**
     * Setter pour l'id du récepteur du message.
     * @param string $receiver
     */
    public function setReceiver(string $receiver) : void 
    {
        $this->receiver = $receiver;
    }

    /**
     * Getter pour l'id de l'expéditeur du message.
     * @return string
     */
    public function getReceiver() : string 
    {
        return $this->receiver;
    }


    /**
     * Getter pour le contenu.
     * @return string
     */
    public function getContent(): string 
    {
        return $this->content;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void 
    {
        $this->content = $content;
    }

    /**
     * Getter pour la date de création.
     * @return DateTime
     */
    public function getDateCreation(): DateTime 
    {
        return $this->dateCreation;
    }

    /**
     * Setter pour la date de création. 
     * Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }
}