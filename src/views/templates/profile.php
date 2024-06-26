<?php
    /**
     * Affichage du compte utilisateur 
     */
?>
<section class="profile">
    <div class="profile_card">
        <h1 class="profile_title">Mon compte</h1>
        <div class="profile_data">
            <div class="profile_info card">
                <input type="file" name="picture" id="imageInput" accept="image/jpg, image/jpeg, image/png, image/webp" class="input_none" form="modifyUserInfo">
                <img class="profile_img" id="previewImage" src="<?= $user->getPicture() ?>" alt="photo de profile">
                <label for="imageInput" class="profile_label">modifier</label>
                <div class="profile_line"></div>
                <h2 class="profile_title"><?= $user->getPseudo() ?></h2>
                <p class="profile_date">Membre depuis 1 an</p>
                <h3 class="profile_subtitle">BIBLIOTHEQUE</h3>
                <div class="profile_count">
                    <img src="public/img/Vector.svg" alt="Icon de livres">
                    <?php if (count($books) == 0) { ?>
                        Pas de livre
                    <?php } elseif (count($books) == 1) { ?>
                        1 livre
                    <?php } else { 
                        echo isset($books) ? count($books) : 0 ?> livres
                    <?php } ?>
                </div>
            </div>

            <div class="profile_information card personalInfo">
                <h3 class="personalInfo_title">Vos informations personnelles</h3>
                <form class="personalInfo_form" action="index.php?action=modifyUserInfo" method="post" id="modifyUserInfo" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                    <label class="personalInfo_label" for="mail">Adresse email</label>
                    <input class="personalInfo_input" type="text" name="mail" id="mail" value="<?= $user->getMail() ?>">
                    <label class="personalInfo_label" for="password">Mot de passe</label>
                    <input class="personalInfo_input" type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    <label class="personalInfo_label" for="pseudo">Pseudo</label>
                    <input class="personalInfo_input" type="text" name="pseudo" id="pseudo"
                        value="<?= $user->getPseudo() ?>">
                    <button type="submit" class="progress_button">Enregistrer</button>
                </form>
            </div>
        </div>
        <div class="profile_books profileBooks">
            <?php if (count($books) > 0) { ?>
                <table class="profileBooks_table">
                    <thead class="profileBooks_head">
                        <tr>
                            <th>PHOTO</th>
                            <th>TITRE</th>
                            <th>AUTEUR</th>
                            <th>DESCRIPTION</th>
                            <th>DISPONIBILITE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="profileBooks_table_tbody">
                        <?php
                        if (isset($books)) {
                            foreach ($books as $book) {
                                ?>
                                <tr>
                                    <td>
                                        <img src="<?= $book->getPicture(); ?>"
                                            alt="Image du livre <?= $book->getTitle(); ?>"></td>
                                    <td class="title">
                                        <?= $book->getTitle(); ?>
                                    </td>
                                    <td class="author">
                                        <?= $book->getAuthor(); ?>
                                    </td>
                                    <td class="available">
                                        <?php if ($book->getAvailable()): ?>
                                            <div class="disponible ">disponible</div>
                                        <?php else: ?>
                                            <div class="indisponible">non dispo.</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <p class="description">
                                            <?= $book->getContent(); ?>
                                        </p>
                                    </td>
                                    <td class="edit-delete">
                                        <a href="index.php?action=showUpdateBookForm&id=<?= $book->getId(); ?>" class="edit">Éditer</a>
                                        <a href="index.php?action=deleteBook&id=<?= $book->getId(); ?>" class="delete" 
                                        <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?") ?>>Supprimer</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</section>