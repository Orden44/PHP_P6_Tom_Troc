<?php
    /**
     * Ce template affiche un livre.
     */
?>

<article class="mainBook">
    <img src="<?= $book->getPicture() ?>" alt="<?= $book->getTitle() ?>"> 

    <?php $available = $book->getAvailable();
    if ($available == false) { ?>
        <img class="book_card_available_detail" src="public/img/non_dispo.png" alt="availability">
    <?php } ?>

    <h2> <?= Utils::format($book->getTitle()) ?> </h2>
    <p><?= 'Par ' . htmlspecialchars($book->getAuthor(), ENT_QUOTES); ?></p>
    <!-- la ligne 15 renvoie à la ligne à cause de la méthode format -->

    <h3>DESCRIPTION</h3>
    <p><?= Utils::format($book->getContent()) ?></p>
    <h3>PROPTIETAIRE</h3>
    <p> <?=$book->getOwner() ?></p>
</article>
