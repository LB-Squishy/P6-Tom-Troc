<?php

/**
 * Template pour afficher une page d'erreur.
 */
?>

<div class="container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <p><?= $errorMessage ?></p>
    <a class="btn btn-success" href="accueil" role="button">Retour à la page d'accueil</a>
</div>