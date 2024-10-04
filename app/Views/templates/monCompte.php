<?php

/**
 * Template pour afficher la page Mon Compte'.
 */
?>

<div class="container margin-container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <div class="moncompte-container">
        <section class="moncompte-section">
            <div class="moncompte-section__section-member">
                <div>
                    <img class="mb-2 profil-miniature" src="<?= htmlspecialchars($miniature_profil_url, ENT_QUOTES, 'UTF-8'); ?>" alt="Photo de profil" />
                    <a href="/mon-compte/edit-miniature">modifier</a>
                </div>
                <div>
                    <div>line</div>
                </div>
                <div>
                    <p><?= htmlspecialchars($pseudo, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><?= htmlspecialchars($date_inscription, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p>BIBLIOTHEQUE</p>
                    <p>LOGO x livres</p>
                </div>
            </div>
        </section>
        <section class="moncompte-section">
            <div class="moncompte-section__section-infos">

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
                            <img class="book-card-admin__image" src="<?= htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>" alt="Couverture du livre" class="livre-miniature" />
                            <p class="book-card-admin__titre"><?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="book-card-admin__auteur"><?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="book-card-admin__description"><?= htmlspecialchars($book->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <div class="book-card-admin__disponibilite">
                                <?php if ($book->getDisponibilite()) : ?>
                                    <div class="book-card-admin__disponibilite--dispo">disponible</div>
                                <?php else : ?>
                                    <div class="book-card-admin__disponibilite--nondispo">non dispo.</div>
                                <?php endif; ?>
                            </div>
                            <div class="book-card-admin__action">
                                <a class="book-card-admin__action--editer" href="#">Éditer</a>
                                <a class="book-card-admin__action--supprimer" href="/suppression-livre?book_id=<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">Supprimer</a>
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