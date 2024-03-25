<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="https://kit.fontawesome.com/fd12a3a6d1.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="index.php">
            <img class="logo" src="public/img/logo.svg" alt="logo Tom Troc">
        </a>       
        <?php if (isset($_SESSION['user'])): ?>
            <nav>
                <ul>
                    <li 
                        class="<?= (isset($_GET['action']) && !empty($_GET['action'] == "home")) ? 'active' : "" ?>">
                        <a href="index.php?action=home">Accueil</a>
                    </li>
                    <li
                        class="<?= (isset($_GET['action']) && !empty($_GET['action'] == "books")) ? 'active' : "" ?>">
                        <a href="index.php?action=books">Nos livres à l'échange</a>                                
                    </li>
                </ul>
            </nav>
            <nav>
                <ul>
                    <li 
                        class="messaging <?= (isset($_GET['action']) && !empty($_GET['action'] == "messaging")) ? 'active' : "" ?>">
                        <img src="public/img/IconMessagerie.svg" alt="icon messagerie">
                        <a href="index.php?action=messaging">Messagerie</a>
                    </li>
                    <li 
                        class="account <?= (isset($_GET['action']) && !empty($_GET['action'] == "profile")) ? 'active' : "" ?>">
                        <img src="public/img/IconMonCompte.svg" alt="icon mon compte">
                        <a href="index.php?action=profile">Mon compte</a>
                    </li>
                    <li
                        class=" <?=(isset($_GET['action']) && !empty($_GET['action'] == "connectionForm")) ? 'active' : "" ?>">
                        <a href="index.php?action=disconnectUser">Déconnexion</a>
                    </li>
                </ul>
            </nav>
            <?php else: ?>
                <nav>
                    <ul>
                        <li
                            class=" <?= (isset($_GET['action']) && !empty($_GET['action'] == "connectionForm")) ? 'active' : "" ?>">
                            <a href="index.php?action=connectUser">Connexion</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
    </header>
    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>    
    <footer>
        <nav>
            <a href="index.php">Politique de confidentialité</a>
            <a href="index.php">Mentions légales</a>
            <a href="index.php">Tom Troc©</a>
            <a href="index.php">
                <img class="logo" src="public/img/Group10.png" alt="logo Tom Troc">
            </a>
        </nav>
    </footer>
    <script src="public/js/script.js"></script>
</body>
</html>