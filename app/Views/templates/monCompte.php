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
                <?php if (!empty($books)): ?>
                    <?php $backgroundImpair = true; ?>
                    <?php foreach ($books as $book): ?>
                        <div class="book-card-admin <?= $backgroundImpair ? "book-card-admin__background-white" : "book-card-admin__background-secondary"; ?>">
                            <img src="<?= htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>" alt="Couverture du livre" class="livre-miniature" />
                            <p><?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><?= htmlspecialchars($book->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <?php if ($book->getDisponibilite()) : ?>
                                <div class="btn-dispo">disponible</div>
                            <?php else : ?>
                                <div class="btn-nondispo">non dispo.</div>
                            <?php endif; ?>
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