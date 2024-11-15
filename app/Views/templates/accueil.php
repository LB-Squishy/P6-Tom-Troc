<?php

/**
 * Template pour afficher la page d'accueil'.
 */
?>

<section class="accueil-section accueil-section__presentation">
    <div class="accueil-section accueil-section__presentation--gauche">
        <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
        <a href="/connexion ?>" class="btn btn-primary accueil-btn">Découvrir</a>
    </div>
    <div class="accueil-section accueil-section__presentation--droite">
        <img src="/src/images/accueil-top-desktop.webp" alt="shop de lecture ruelle">
        <p>Hamza</p>
    </div>
</section>
<section class="accueil-section accueil-section__livres">
    <h2>Les derniers livres ajoutés</h2>
    <div class="last-livre__container">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <?php include 'app/Views/components/bookCard.php'; ?>
            <?php endforeach ?>
        <?php endif; ?>
    </div>
    <a href="/nos-livres ?>" class="btn btn-primary accueil-btn">Voir tous les livres</a>
</section>
<section class="accueil-section accueil-section__fonctionnement">
    <h2>Comment ça marche ?</h2>
    <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
    <a href="/nos-livres ?>" class="btn btn-secondary accueil-btn">Voir tous les livres</a>
    <img src="/src/images/accueil-bottom-desktop.webp" alt="femme dans une bibliothèque" class="accueil-section__fonctionnement--image">
</section>
<section class="accueil-section accueil-section__valeurs">
    <h2>Nos valeurs</h2>
</section>