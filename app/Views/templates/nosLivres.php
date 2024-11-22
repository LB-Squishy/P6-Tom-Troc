<?php

/**
 * Template pour afficher la page Nos Livres.
 */
?>
<section class="nosLivres-section">
    <div class="nosLivres-section__header">
        <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
        <form method="GET" action="/nos-livres" class="champs-recherche">
            <button type="submit" class="champs-recherche__button"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="rechercheLivre" placeholder="Rechercher un livre" class="champs-recherche__input" value="<?= isset($_GET["rechercheLivre"]) ? htmlspecialchars($_GET["rechercheLivre"], ENT_QUOTES, 'UTF-8') : "" ?>">
        </form>
    </div>

    <div class="nosLivres-section__bookList">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <?php include 'app/Views/components/bookCard.php'; ?>
            <?php endforeach ?>
        <?php endif; ?>
    </div>
</section>