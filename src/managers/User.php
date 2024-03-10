<?php

/**
 * Entité User : un user est défini par les champs
 * id, pseudo, password, mail, picture, date_creation
 */ 
class User extends AbstractEntity 
{
    private string $pseudo = "";
    private string $password = "";
    private string $mail = "";
    private ?string $picture = "";
    private ?DateTime $dateCreation = null;

    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo) : void 
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getPseudo() : string 
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void 
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string 
    {
        return $this->password;
    }

    /**
     * Setter pour le mail.
     * @param string $mail
     */
    public function setMail(string $mail) : void 
    {
        $this->mail = $mail;
    }

    /**
     * Getter pour le mail.
     * @return string
     */
    public function getMail() : string 
    {
        return $this->mail;
    }

    /**
     * Setter pour la photo de l'utilisateur
     * @param string $picture
     */
    public function setPicture(?string $picture) : void 
    {
        $this->picture = $picture;
    }

    /**
     * Getter pour la photo.
     * @return string
     */
    public function getPicture() : string 
    {
        return $this->picture;
    }

    /**
     * Setter pour la date d'inscription. Si la date est une string, on la convertit en DateTime.
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

    /**
     * Getter pour la date d'inscription.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getDateCreation() : DateTime 
    {
        return $this->dateCreation;
    }
}