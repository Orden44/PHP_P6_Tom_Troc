<?php
    /**
     * Affichage de Liste des livres. 
     */
?>
<section class="readers">
    <div class="readers_description">
        <h1>Rejoignez nos lecteurs passionnés</h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
        <a href="index.php?action=books">
            <button class="button">Découvrir</button>
        </a>
    </div>
    <div class="readers_img">
        <img src="public/img/hamza.jpg" alt="reader behind many books on display">
        <p>hamza</p>
    </div>
</section>
<section class="bookList">
    <h2 class="bookList_title">Les derniers livres ajoutés</h2>
    <div class="books_cards">
        <?php foreach($books as $book) { ?>
            <div class="book_card">
                <a href="index.php?action=showBook&id=<?= $book->getId() ?>">
                    <img class="book_card_img" src="<?= $book->getPicture() ?>" alt="<?= $book->getTitle() ?>">
                    <div class="book_card_description">
                        <h3 class="book_card_title"><?= $book->getTitle() ?></h3>
                        <p class="book_card_author"><?= $book->getAuthor() ?></p>
                        <p class="book_card_owner">Vendu par : <?=$book->getOwner() ?></p>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
    <a href="index.php?action=books">
        <button class="button">Voir tous les livres</button>
    </a>
</section>
<section class="progress">
    <div class="progress_description">
        <h2>Comment ça marche ?</h2>
        <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
        <div class="progress_steps">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
        <a href="index.php?action=books">
            <button class="progress_button">Voir tous les livres</button>
        </a>
    </div>
    <div class="progress_img">
        <img src="public/img/ReaderInLibrary.png" alt="reader in library">
    </div>
</section>
<section class="values">
    <div class="values_description">
        <h2>Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
        <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
        <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
    </div>
    <div class="values_img">
        <p>L'équipe Tom Troc</p>
        <img src="public/img/Vector2.svg" alt="heart icon">
    </div>
</section>
