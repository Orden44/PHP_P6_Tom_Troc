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
        <img class="logo" src="public/img/logo.svg" alt="logo Tom Troc">
        <nav>
            <a href="index.php">Acceuil</a>
            <a href="index.php?action=books">Nos livres à l'échange</a>
        </nav>
        <nav>
            <a href="index.php?action=messaging">Messagerie</a>
            <a href="index.php?action=compte">Mon compte</a>
            <a href="index.php?action=connexion">Connexion</a>
        </nav>
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        <p>Copyright © Tom Troc 2024 - Openclassrooms</p>
    </footer>
</body>
</html>