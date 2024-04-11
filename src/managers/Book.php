<?php

/**
 * Entité Book, un livre est défini par les champs
 * id, title, author, picture, content, propriétaire, image du propriétaire, available
 */
 class Book extends AbstractEntity 
 {
    private string $title = "";
    private string $author = "";
    private ?string $picture = "";
    private string $content = "";
    private int $userId;
    private string $owner = "";
    private string $userImage = "";
    private bool $available = false;

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getTitle(int $length = -1) : string 
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $title = mb_substr($this->title, 0, $length);
            if (strlen($this->title) > $length) {
                $title .= "...";
            }
            return $title;
        }
        return $this->title;
    }

    /**
     * Setter pour l'auteur du livre.
     * @param string $author
     */
    public function setAuthor(string $author) : void 
    {
        $this->author = $author;
    }

    /**
     * Getter pour l'auteur.
     * @return string
     */
    public function getAuthor() : string 
    {
        return $this->author;
    }

    /**
     * Setter pour l'image du livre.
     * @param string $picture
     */
    public function setPicture(?string $picture) : void 
    {
        $this->picture = $picture;
    }

    /**
     * Getter pour l'image.
     * @return string
     */
    public function getPicture() : ?string 
    {
        return $this->picture;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public function setContent(string $content) : void 
    {
        $this->content = $content;
    }

    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1) : string 
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

    /**
     * Setter pour l'id du possesseur.
     * @param int $userId
     */
    public function setUserId(int $userId) : void
    {
        $this->userId = $userId;
    }

    /**
     * Getter pour l'id du possesseur.
     * @return int
     */
    public function getUserId() : int
    {
        return $this->userId;
    }

    /**
     * Setter pour le possesseur.
     * @param string $owner
     */
    public function setOwner(string $owner) : void 
    {
        $this->owner = $owner;
    }

    /**
     * Getter pour le possesseur.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getOwner(int $length = -1) : string 
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $owner = mb_substr($this->owner, 0, $length);
            if (strlen($this->title) > $length) {
                $owner .= "...";
            }
            return $owner;
        }
        return $this->owner;
    }

    /**
     * Getter pour l'image du possesseur.
     * @return string
     */
    public function getUserImage(): string
    {
        return $this->userImage;
    }

    /**
     * Setter pour l'id du posssesseur du livre. 
     * @param string $idUser
     */
    public function setUserImage(string $userImage): void
    {
        $this->userImage = $userImage;
    }

    /**
     * Setter pour la disponibilité du livre.
     * @param bool $available
     */
    public function setAvailable(bool $available) : void 
    {
        $this->available = $available;
    }

    /**
     * Getter pour la disponibilité.
     * @return bool
     */
    public function getAvailable() : bool
    {
        return $this->available;
    }

    /**
     * Set l'URL de l'image à partir d'un formulaire soumis.
     * La méthode renvoie un tableau d'erreurs si l'image n'est pas valide.
     * @param string $imgName
     * @param string $filePath
     * @return array
     */
    public function setImageFromForm($imgName, $filePath): array 
    {
        if (!empty($_FILES[$imgName]['name'])) {
            list($picErrors, $picPath) = Utils::uploadImage($imgName, $filePath);

            if (empty($picErrors)) {
                $this->setPicture($picPath);
            }
        } 
        return $picErrors ?? [];
    }
 }