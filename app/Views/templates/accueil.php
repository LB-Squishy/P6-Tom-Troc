<?php

/**
 * Template pour afficher la page d'accueil.
 */
?>

<section class="accueil-section accueil-section__presentation">
    <div class="accueil-section accueil-section__presentation--gauche">
        <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
        <a href="/nos-livres" class="btn btn-primary accueil-btn">Découvrir</a>
    </div>
    <div class="accueil-section accueil-section__presentation--droite">
        <img src="/src/images/accueil-top-banner.webp" alt="shop de lecture ruelle">
        <p>Hamza</p>
    </div>
</section>
<section class="accueil-section accueil-section__livres">
    <h2>Les derniers livres ajoutés</h2>
    <div class="accueil-section__livres--card-container">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <?php include 'app/Views/components/bookCard.php'; ?>
            <?php endforeach ?>
        <?php endif; ?>
    </div>
    <a href="/nos-livres" class="btn btn-primary accueil-btn">Voir tous les livres</a>
</section>
<section class="accueil-section accueil-section__fonctionnement">
    <h2>Comment ça marche ?</h2>
    <p class="accueil-section__fonctionnement--texte">Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
    <div class="accueil-section__fonctionnement--container">
        <div class="accueil-section__fonctionnement--card">
            <p>Inscrivez-vous gratuitement sur
                notre plateforme.</p>
        </div>
        <div class="accueil-section__fonctionnement--card">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </div>
        <div class="accueil-section__fonctionnement--card">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </div>
        <div class="accueil-section__fonctionnement--card">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
    </div>
    <a href="/nos-livres" class="btn btn-secondary accueil-btn">Voir tous les livres</a>
    <img src="/src/images/accueil-bottom-banner.webp" alt="femme dans une bibliothèque" class="accueil-section__fonctionnement--image">
</section>
<section class="accueil-section accueil-section__valeurs">
    <div class="section-valeur-container">
        <h2>Nos valeurs</h2>
        <div class="section-valeur-container__texte">
            <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
            <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
            <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        </div>
        <div class="section-valeur-container__signature">
            <p>L’équipe Tom Troc</p>
            <img src="/src/images/signature-coeur.png" alt="signature coeur" class="">
        </div>
    </div>
</section>