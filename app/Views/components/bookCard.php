<?php

/**
 * Composant pour afficher les cards des livres.
 */
?>
<?php if (isset($book)): ?>
    <a class="link-livre-card" href="/livre?book_id=<?= htmlspecialchars($book->getId(), ENT_QUOTES, 'UTF-8'); ?>">
        <div class="livre-card">
            <img class="livre-card__image" src="<?= BOOK_SMALL_COVER_PATH . htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>" alt="Couverture du livre" class="livre-miniature" />
            <div class="livre-card__container">
                <p class="livre-card__titre"><?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="livre-card__auteur"><?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="livre-card__proprietaire">Vendu par : <?= htmlspecialchars($book->getUserPseudo(), ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    </a>
<?php endif; ?>