<?php

/**
 * Entité représentant un message.
 * Avec les champs id, id_user, content et date_creation.
 */
class Message extends AbstractEntity 
{
    private int $idUser;
    private string $content = "";
    private ?DateTime $dateCreation = null;
    
    /**
     * Getter pour l'id du destinataire du message.
     * @return int
     */
    public function getIdUser(): int 
    {
        return $this->idUser;
    }

    /**
     * Setter pour l'id du destinataire.
     * @param int $idUser
     * @return void
     */
    public function setIdUser(int $idUser): void 
    {
        $this->idUser = $idUser;
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