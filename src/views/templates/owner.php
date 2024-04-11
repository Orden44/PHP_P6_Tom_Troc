<?php
    /**
     * Affichage du compte utilisateur 
     */
?>
<section class="owner">
    <div class="owner_card">
        <img class="owner_img" id="previewImage" src="<?= $user->getPicture() ?>" alt="photo de profile">
        <div class="owner_line"></div>
        <h2 class="owner_title"><?= $user->getPseudo() ?></h2>
        <p class="owner_date">Membre depuis 1 an</p>
        <h3 class="owner_subtitle">BIBLIOTHEQUE</h3>
        <div class="owner_count">
            <img src="public/img/Vector.svg" alt="Icon de livres">
            <?php if (count($books) == 0) { ?>
                Pas de livre
            <?php } elseif (count($books) == 1) { ?>
                1 livre
            <?php } else { 
                echo isset($books) ? count($books) : 0 ?> livres
            <?php } ?>
        </div>
        <form action="index.php?action=messaging&id=<?= $user->getId() ?>" method="post">
            <input type="hidden" name="id" value="<?= $user->getId() ?>">
            <button type="submit" class="progress_button">Écrire un message</button>
        </form>
    </div>

    <div class="owner_books ownerBooks">
        <?php if (count($books) > 0) { ?>
            <table class="ownerBooks_table">
                <thead class="ownerBooks_head">
                    <tr>
                        <th>PHOTO</th>
                        <th>TITRE</th>
                        <th>AUTEUR</th>
                        <th>DESCRIPTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($books)) {
                        foreach ($books as $book) {
                            ?>
                            <tr>
                                <td>
                                    <a href="index.php?action=showBook&id=<?= $book->getId() ?>">
                                        <img src="<?= $book->getPicture(); ?>"
                                        alt="Image du livre <?= $book->getTitle(); ?>"></td>
                                    </a>
                                <td class="title">
                                    <?= $book->getTitle(); ?>
                                </td>
                                <td class="author">
                                    <?= $book->getAuthor(); ?>
                                </td>
                                <td>
                                    <p class="description">
                                        <?= $book->getContent(); ?>
                                    </p>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</section>