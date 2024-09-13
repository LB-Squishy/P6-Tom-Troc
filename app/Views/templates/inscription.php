<?php

/**
 * Template pour afficher la page d'inscription'.
 */
?>

<div class="container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <form method="POST" action="submit-inscription">
        <label for="pseudo">Pseudo</label>
        <input id="pseudo" type="text" name="pseudo" required>
        <label for="email">Adresse email</label>
        <input id="email" type="email" name="email" required>
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="connexion">Connectez-vous</a></p>
    <?php if (isset($error)) : ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</div>