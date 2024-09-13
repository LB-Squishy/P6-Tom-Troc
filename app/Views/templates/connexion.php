<?php

/**
 * Template pour afficher la page de connexion'.
 */
?>

<div class="container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <form method="POST" action="submit-connexion">
        <label for="email">Adresse email</label>
        <input id="email" type="email" name="email" required>
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas de compte ? <a href="inscription">Inscrivez-vous</a></p>
    <?php if (isset($error)) : ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</div>