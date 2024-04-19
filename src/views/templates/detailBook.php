<?php
    /**
     * Ce template affiche un livre.
     */
?>
<article class="detailBook">
    <img class="detailBook_img" src="<?= $book->getPicture() ?>" alt="<?= $book->getTitle() ?>"> 
    <div class="detailBook_description">
        <?php $available = $book->getAvailable();
        if ($available == false) { ?>
            <img class="detailBook_available" src="public/img/non_dispo.png" alt="availability">
        <?php } ?>

        <h1 class="detailBook_title"> <?= Utils::format($book->getTitle()) ?> </h1>
        <p class="detailBook_author"><?= 'par ' . htmlspecialchars($book->getAuthor(), ENT_QUOTES); ?></p>
        <p class="detailBook_line3">____</p>

        <h3 class="detailBook_subtitle">DESCRIPTION</h3>
        <div class="detailBook_content">
            <p><?= Utils::format($book->getContent()) ?></p>
        </div>
        <h3 class="detailBook_subtitle">PROPRIETAIRE</h3>

        <div class="detailBook_owner">
            <img class="detailBook_owner_img" src="<?= $book->getUserImage() ?>" alt="<?= $book->getOwner() ?>">
            <a href="index.php?action=owner&id=<?= $book->getUserId() ?>">
                <p><?= $book->getOwner() ?></p>
            </a>
        </div>
        <form action="index.php?action=owner&id=<?= $book->getUserId() ?>" method="post">
            <input type="hidden" name="id" value="<?= $book->getUserId() ?>">
            <button type="submit" class="button">Envoyer un message</button>
        </form>
    </div>
</article>
