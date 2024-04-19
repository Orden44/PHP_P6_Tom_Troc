<?php 
    /** 
     * Template du formulaire de modification d'un livre.. 
     */
?>
<div class="updateBook">
    <div class="updateBook_title">
        <a href="index.php?action=profile&id=<?= $_SESSION['idUser'] ?>">&larr; retour</a>
        <h1>Modifier les informations</h1>
    </div>
    <div class="updateBook_data">
        <div class="updateBook_img">
            <span class="updateBook_subTitle">Photo</span>
            <input type="file" name="picture" id="imageInput" accept="image/jpg, image/jpeg, image/png, image/webp" class="input_none" form="updateBook">
            <img id="previewImage" src="<?= $book->getPicture() ?>" alt="Couverture du livre">
            <label for="imageInput">Modifier la photo</label>
        </div>

        <form action="index.php?action=updateBook" method="post" class="updateBook_form" id="updateBook" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $book->getId() ?>">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="<?= $book->getTitle() ?>" required>
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" value="<?= $book->getAuthor() ?>">
            <label for="content">Commentaire</label>
            <textarea name="content" id="content"><?= $book->getContent() ?></textarea>
            <label for="available">Disponibilité</label>
            <select name="available" id="available">
                <option value="true">disponible</option>
                <option value="false" <?= $book->getAvailable() ? '' : 'selected'  ?>>non disponible</option>
            </select>
            <button type="submit" class="button">Valider</button>
        </form>
    </div>
</div>
