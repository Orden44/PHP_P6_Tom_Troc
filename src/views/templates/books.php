<?php
    /**
     * Affichage de Liste des livres. 
     */
?>
<section class="bookList">
    <div class="book_search">
        <h1 class="bookList_title">Nos livres à l'échange</h1>
        <form action="index.php?action=books" class="search" method="post">
            <div class="input-container">
                <input class="search_input" type="search" name="search" placeholder="Rechercher un livre">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </form>
    </div>
    <div class="books_cards">
        <?php if (is_null($books)) { ?>
            <p>Aucun livre ne correspond à votre recherche.</p>
        <?php } else { 
            foreach($books as $book) { ?>
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
            <?php } 
        }?>
    </div>
</section>