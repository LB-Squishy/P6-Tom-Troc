<?php

/**
 * Template pour afficher une page d'erreur 404.
 */
?>

<div class="container error404">
    <h1 class="error404__title"><?= htmlspecialchars($title) ?></h1>
    <img class="error404__image" src="/src/images/404.webp" alt="erreur 404">
    <a class="btn btn-primary" href="/accueil" role="button">Retour à la page d'accueil</a>
</div>