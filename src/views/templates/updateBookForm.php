<?php 
    /** 
     * Template du formulaire de modification d'un livre.. 
     */
?>

<h2 class="updateBook_title">Modifier les informations</h2>
<div class="updateBook-img">
    <span class="updateBook_subTitle">Photo</span>
    <input type="file" name="picture" id="modifyBookImg" class="input_none" form="updateBook"/>
    <div class="updateBook_cover" id="userPicWrap">
        <img src="<?= $book->getPicture() ?>" alt="Couverture du livre">
    </div>
    <label for="modifyBookImg" role="button">modifier la photo</label>
</div>

<form action="index.php?action=updateBook" method="post" class="updateBook_form" id="updateBook" enctype="multipart/form-data">
    <div class="formGrid">
        <input type="hidden" name="id" value="<?= $book->getId() ?>">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value="<?= $book->getTitle() ?>" required>
        <label for="author">Auteur</label>
        <input type="text" name="author" id="author" value="<?= $book->getAuthor() ?>">
        <label for="content">Commentaire</label>
        <textarea name="content" id="content" cols="30" rows="10"><?= $book->getContent() ?></textarea>
        <label for="available">Disponibilité</label>
        <select name="available" id="available">
            <option value="true">disponible</option>
            <option value="false" <?= $book->getAvailable() ? '' : 'selected'  ?>>non disponible</option>
        </select>
        <button type="submit" class="button">Valider</button>
    </div>
</form>
