<?php

/**
 * Template pour afficher la page Mon Compte.
 */
require_once './app/Services/Anciennete.php'
?>

<div class="container margin-container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <div class="moncompte-container">
        <section class="moncompte-section">
            <div class="moncompte-section__section-member">
                <div class="moncompte-section__section-member--photo">
                    <img class="mb-2 profil-miniature" src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($miniature_profil_url, ENT_QUOTES, 'UTF-8'); ?>" alt="Photo de profil" />
                    <a class="moncompte-section__section-member--modifier" data-bs-toggle="modal" data-bs-target="#photoModal">modifier</a>
                </div>
                <!-- Modale pour modifier la photo de profil -->
                <div class="modal fade" id="photoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="photoModalLabel">Changer la photo de profil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="photoForm" method="POST" action="/mon-compte/edit-miniature" enctype="multipart/form-data">
                                    <input type="file" name="photo" accept="image/*" required>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="cancelPhotoButton">Annuler</button>
                                <button type="button" class="btn btn-primary" id="confirmPhotoButton">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <hr class="moncompte-section__section-member--ligne" />
                </div>
                <div>
                    <p class="moncompte-section__section-member--pseudo"><?= htmlspecialchars($pseudo, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="moncompte-section__section-member--anciennete">Membre depuis <?= calculerAnciennete(htmlspecialchars($date_inscription, ENT_QUOTES, 'UTF-8')); ?></p>
                    <p class="moncompte-section__section-member--biblio">BIBLIOTHEQUE</p>
                    <p><i class="fa-solid fa-lines-leaning"></i></i></i> <?= count($books); ?> livres</p>
                    <!-- Bouton pour rediriger vers le compte public -->
                    <a href="/compte-public/?pseudo=<?= urlencode($pseudo) ?>" class="moncompte-section__section-member--modifier">Compte public</a>
                </div>
            </div>
        </section>
        <section class="moncompte-section">
            <div class="moncompte-section__section-infos">
                <p class="moncompte-section__section-infos--title">Vos informations personnelles</p>
                <form id="infoUserForm" method="POST" action="/mon-compte/maj-infos-utilisateur">
                    <div class="mb-3">
                        <label class="form-label" for="email">Adresse email</label>
                        <input class="moncompte-section__section-infos--form-control form-control" id="email" type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input class="moncompte-section__section-infos--form-control form-control" id="password" type="password" name="password" value="" placeholder="••••••••••" required>
                    </div>
                    <div class="mb-5">
                        <label class="form-label" for="pseudo">Pseudo</label>
                        <input class="moncompte-section__section-infos--form-control form-control" id="pseudo" type="text" name="pseudo" value="<?= htmlspecialchars($pseudo, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <button class="btn btn-secondary" type="button" id="showModalButton" data-bs-toggle="modal" data-bs-target="#confirmationModal">Enregistrer</button>
                </form>
            </div>
            <!-- Modale de confirmation -->
            <div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="confirmationMessage">Êtes-vous sûr de vouloir modifier vos informations utilisateur ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelButton">Annuler</button>
                            <button type="button" class="btn btn-primary" id="confirmButton">Confirmer</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="moncompte-section">
            <div class="moncompte-section__section-book">
                <div class="moncompte-section__section-book--header">
                    <p>Photo</p>
                    <p>Titre</p>
                    <p>Auteur</p>
                    <p>Description</p>
                    <p>Disponibilite</p>
                    <p>Action</p>
                </div>
                <?php if (!empty($books)): ?>
                    <?php $backgroundImpair = true; ?>
                    <?php foreach ($books as $book): ?>
                        <div class="book-card-admin <?= $backgroundImpair ? "book-card-admin__background-white" : "book-card-admin__background-secondary"; ?>">
                            <img class="book-card-admin__image" src="<?= BOOK_SMALL_COVER_PATH . htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>" alt="Couverture du livre" class="livre-miniature" />
                            <p class="book-card-admin__titre"><?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="book-card-admin__auteur"><?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="book-card-admin__description"><?= htmlspecialchars($book->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <div class="book-card-admin__disponibilite">
                                <?php if ($book->getDisponibilite()) : ?>
                                    <div class="book-card-admin__disponibilite--dispo">
                                        <a class="book-card-admin__disponibilite" href="/mon-compte/disponibilite-livre?book_id=<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">disponible
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="book-card-admin__disponibilite--nondispo">
                                        <a class="book-card-admin__disponibilite" href="/mon-compte/disponibilite-livre?book_id=<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">non dispo.
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="book-card-admin__action">
                                <a class="book-card-admin__action--editer" href="/edition-livre?book_id=<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">Éditer</a>
                                <a class="book-card-admin__action--supprimer" href="/mon-compte/suppression-livre?book_id=<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">Supprimer</a>
                            </div>
                        </div>
                        <?php $backgroundImpair = !$backgroundImpair; ?>
                    <?php endforeach ?>
                <?php else: ?>
                    <div class="p-5 align-content">
                        <div class="btn btn-primary">Ajoutez votre premier livre</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>