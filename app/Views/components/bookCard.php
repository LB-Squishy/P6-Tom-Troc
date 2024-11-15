<?php

/**
 * Composant pour afficher les cards des livres.
 */
?>
<?php if (isset($book)): ?>
    <div class="last-livre__card">
        <img class="last-livre__card__image" src="<?= BOOK_SMALL_COVER_PATH . htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>" alt="Couverture du livre" class="livre-miniature" />
        <p class="last-livre__card__titre"><?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="last-livre__card__auteur"><?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="last-livre__card__proprietaire">Vendu par : <?= htmlspecialchars($book->getUserPseudo(), ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
<?php endif; ?>