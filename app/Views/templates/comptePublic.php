<?php

/**
 * Template pour afficher la page compte public'.
 */
?>

<div class="container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <p>Le mail de l'utilisateur connecté est : <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>Sa date d'inscription est : <?= htmlspecialchars($date_inscription, ENT_QUOTES, 'UTF-8'); ?></p>
    <img src="<?= htmlspecialchars($miniature_profil_url, ENT_QUOTES, 'UTF-8'); ?>" alt="Photo de profil" class="profil-miniature" />
</div>