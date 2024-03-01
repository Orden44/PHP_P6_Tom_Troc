<?php
    /**
     * Affichage de Liste des livres. 
     */
?>
<section class="bookList">
    <h2 class="bookList_title">Nos livres à l'échange</h2>
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
                    <?php $available = $book->getAvailable();
                    if ($available == false) { ?>
                        <img class="book_card_available" src="public/img/non_dispo.png" alt="availability">
                     <?php } ?>
                </a>
            </div>
        <?php } ?>
    </div>
</section>