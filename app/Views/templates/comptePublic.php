<?php

/**
 * Template pour afficher la page Mon Compte Public.
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
                    <a href="/messagerie/?pseudo=<?= urlencode($pseudo) ?>" class="btn btn-secondary">Ecrire un message</a>
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
                </div>
                <?php if (!empty($books)): ?>
                    <?php $backgroundImpair = true; ?>
                    <?php foreach ($books as $book): ?>
                        <div class="book-card-admin <?= $backgroundImpair ? "book-card-admin__background-white" : "book-card-admin__background-secondary"; ?>">
                            <img class="book-card-admin__image" src="<?= BOOK_SMALL_COVER_PATH . htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>" alt="Couverture du livre" class="livre-miniature" />
                            <p class="book-card-admin__titre"><?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="book-card-admin__auteur"><?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="book-card-admin__description"><?= htmlspecialchars($book->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
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