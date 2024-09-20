<?php

/**
 * Template pour afficher la page d'accueil'.
 */
?>

<div class="container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <?php if ($email !== 'Non connecté') : ?>
        <p>Le mail de l'utilisateur connecté est : <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Sa date d'inscription est : <?= htmlspecialchars($date_inscription, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php else : ?>
        <p>Bienvenue.</p>
    <?php endif; ?>
</div>