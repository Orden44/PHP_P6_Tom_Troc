<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */
class UserManager extends AbstractEntityManager 
{
    /**
     * Rechercher un utilisateur par un paramètre.
     * @param string $attr : l'attribut à rechercher.
     * @param string|int $value : la valeur de l'attribut.
     * @return User : l'utilisateur.
     */
    public function findUser(string $attr, string|int $value) : ?User
    {
        $sql = "SELECT * FROM user WHERE $attr = :$attr";
        $result = $this->db->query($sql, [$attr => $value]);
        $user = $result->fetch();
        return $user ? new User($user) : null;
    }

    /**
     * Ajouter un utilisateur.
     * @param User $user : l'objet User à ajouter.
     * @return bool : true si l'ajout a réussi, false sinon.
     */
    public function addUser(User $user) : bool
    {
        $sql = "INSERT INTO user (pseudo, password, mail, date_creation) VALUES (:pseudo, :password, :mail, NOW())";
        $result = $this->db->query($sql, [
        'pseudo' => $user->getPseudo(),
        'password' => $user->getPassword(),
        'mail' => $user->getMail(),
        ]);
        return $result->rowCount() > 0;
    }
}