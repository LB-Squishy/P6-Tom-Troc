<?php

/**
 * Template pour afficher la page de détail d'un Livre'.
 */
?>

<div class="book-detail">
    <div class="book-detail__image">
        <img src="<?= BOOK_SMALL_COVER_PATH . htmlspecialchars($book->getImageUrl(), ENT_QUOTES, 'UTF-8'); ?>"
            alt="Image du livre : <?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?>" />
    </div>
    <div class="book-detail__info">
        <h1 class="book-detail__titre"><?= htmlspecialchars($book->getTitre(), ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="book-detail__auteur">par <?= htmlspecialchars($book->getAuteur(), ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="book-detail__ligne"></div>
        <p class="book-detail__intitule">description</p>
        <p class="book-detail__description"><?= htmlspecialchars($book->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="book-detail__intitule">proprietaire</p>
        <div class="book-detail__proprietaire">
            <img class=" book-detail__proprietaire--image profil-miniature" src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($book->getMiniatureProfilUrl(), ENT_QUOTES, 'UTF-8'); ?>" alt="Photo de profil" />
            <p class="book-detail__proprietaire--nom"><?= htmlspecialchars($book->getUserPseudo(), ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <a href="/messagerie/?pseudo=<?= ($book->getUserPseudo()) ?>" class="btn btn-primary book-detail__btnmessage">Ecrire un message</a>
    </div>
</div>