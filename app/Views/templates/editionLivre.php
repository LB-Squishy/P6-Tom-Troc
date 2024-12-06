<?php

/**
 * Template pour afficher la page d'edition d'un Livre'.
 */
?>
<div class="container editBook-margin-container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <div class="editBook-container">
        <div class="editBook-detail">
            <div class="editBook-detail__image">
                <p class="editBook-detail__image--texte">Photo</p>
                <img src="<?= BOOK_SMALL_COVER_PATH . htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>"
                    alt="Image du livre : <?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?>" />
                <a class="editBook-detail__image--modifier" data-bs-toggle="modal" data-bs-target="#bookCoverModal">Modifier la photo</a>
            </div>
            <!-- Modale pour modifier la photo de couverture de livre -->
            <div class="modal fade" id="bookCoverModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bookCoverModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookCoverModalLabel">Changer la photo de couverture</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="bookCoverForm" method="POST" action="/edition-livre/edit-book-cover" enctype="multipart/form-data">
                                <input type="hidden" name="book_id" value="<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="file" name="bookCover" accept="image/*" required>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelbookCoverButton">Annuler</button>
                            <button type="button" class="btn btn-primary" id="confirmbookCoverButton">Confirmer</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="editBook-detail__info">
                <form id="editBookForm" method="POST" action="/edition-livre/edit-book-infos">
                    <div class="editBook-detail__info--margin">
                        <input type="hidden" name="book_id" value="<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">
                        <label class="form-label" for="titre">Titre</label>
                        <input
                            class="editBook-detail__info--form-control form-control"
                            id="titre"
                            type="text"
                            name="titre"
                            value="<?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?>"
                            required>
                    </div>
                    <div class="editBook-detail__info--margin">
                        <label class="form-label" for="auteur">Auteur</label>
                        <input
                            class="editBook-detail__info--form-control form-control"
                            id="auteur"
                            type="text"
                            name="auteur"
                            value="<?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?>"
                            required>
                    </div>
                    <div class="editBook-detail__info--margin">
                        <label class="form-label" for="commentaire">Commentaire</label>
                        <textarea
                            class="editBook-detail__info--form-control form-control"
                            id="commentaire"
                            name="commentaire"
                            required><?= htmlspecialchars($book->getDescription(), ENT_QUOTES, 'UTF-8'); ?>
                        </textarea>
                    </div>
                    <div class="editBook-detail__info--margin">
                        <label class="form-label" for="disponibilite">Disponibilité</label>
                        <select
                            class="editBook-detail__info--form-control form-select"
                            id="disponibilite"
                            name="disponibilite"
                            required>
                            <option value="1" <?= $book->getDisponibilite() ? 'selected' : ''; ?>>Disponible</option>
                            <option value="0" <?= !$book->getDisponibilite() ? 'selected' : ''; ?>>Indisponible</option>
                        </select>
                    </div>
                    <button class="btn  btn-primary editBook-detail__btn" type="button" id="showModalButton" data-bs-toggle="modal" data-bs-target="#editBookModal">Valider</button>
                </form>
            </div>
            <!-- Modale de confirmation -->
            <div class="modal fade" id="editBookModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationEditBookModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="confirmationEditBookMessage">Êtes-vous sûr de vouloir modifier vos informations utilisateur ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelEditBookButton">Annuler</button>
                            <button type="button" class="btn btn-primary" id="confirmEditBookButton">Confirmer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>