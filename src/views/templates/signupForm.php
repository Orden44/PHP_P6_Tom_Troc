<?php
    /**
     * Template pour afficher le formulaire d'inscription.
     */
?>

<div class="connection-form">
    <form action="index.php?action=registerUser" method="post">
        <h1>Inscription</h1>
        <div class="formGrid">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>
            <label for="mail">Adresse email</label>
            <input type="text" name="mail" id="mail" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="button">S'inscrire</button>
            <div class="registration">
                <p>Déjà inscrit ? </p>
                <a href="index.php?action=connectionForm">Connectez-vous</a>
            </div>
        </div>
    </form>
    <img src="public/img/Connect.png" alt="bibliothèque">      
</div>