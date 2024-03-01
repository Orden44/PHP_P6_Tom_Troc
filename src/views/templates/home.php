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
                        <!-- <?= "<pre>"; print_r($book); echo "</pre>"; ?> -->
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
            <button class="button progress_button">Voir tous les livres</button>
        </a>
    </div>
    <div class="progress_img">
        <img src="public/img/reader in library.png" alt="reader in library">
    </div>
</section>
