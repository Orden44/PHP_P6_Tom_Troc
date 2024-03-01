<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */
class UserManager extends AbstractEntityManager 
{
    /**
     * Récupère un user par son pseudo.
     * @param string $pseudo
     * @return ?User
     */
    public function getUserByPseudo(string $pseudo) : ?User 
    {
        $sql = "SELECT * FROM user WHERE pseudo = :pseudo";
        $result = $this->db->query($sql, ['pseudo' => $pseudo]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }
}