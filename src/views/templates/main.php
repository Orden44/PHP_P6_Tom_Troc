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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a href="index.php">
            <img class="logo" src="public/img/logo.svg" alt="logo Tom Troc">
        </a>
        <?php 
                // Si on est connecté, on affiche le menu
                if (isset($_SESSION['user'])) {
                    echo '<nav>
                            <a href="index.php">Accueil</a>
                            <a href="index.php?action=books">Nos livres à l\'échange</a>
                        </nav>
                        <nav>
                            <div class="messaging">
                                <img src="public/img/IconMessagerie.svg" alt="icon messagerie">
                                <a href="index.php?action=messaging">Messagerie</a>
                                <div class="nbrMessage">3</div>
                            </div>
                            <div class="account">
                                <img src="public/img/IconMonCompte.svg" alt="icon mon compte">
                                <a href="index.php?action=compte">Mon compte</a>
                            </div>
                            <a href="index.php?action=disconnectUser">Déconnexion</a>
                        </nav>';
                } else {
                    echo '<nav>
                            <a href="index.php">Accueil</a>
                        </nav>';
                }
        ?>
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        <nav>
            <a href="#">Politique de confidentialité</a>
            <a href="#">Mentions légales</a>
            <a href="#">Tom Troc©</a>
            <a href="index.php">
                <img class="logo" src="public/img/Group10.png" alt="logo Tom Troc">
            </a>
        </nav>
    </footer>
</body>
</html>