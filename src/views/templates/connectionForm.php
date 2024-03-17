<?php
    /**
     * Template pour afficher le formulaire de connexion.
     */
?>

<div class="connection-form">
    <form action="index.php?action=connectUser" method="post">
        <h1>Connexion</h1>
        <div class="formGrid">
            <label for="mail">Adresse email</label>
            <input type="text" name="mail" id="mail" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="button">S'inscrire</button>
            <div class="registration">
                <p>Pas de compte ? </p>
                <a href="index.php?action=signupForm">Inscrivez-vous</a>
            </div>
        </div>
    </form>
    <img src="public/img/Connect.png" alt="bibliothèque">      
</div>