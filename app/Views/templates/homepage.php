<?php

/**
 * Template pour afficher la page d'accueil'.
 */
?>

<div class="container">
    <h1>Bienvenue sur la page d'<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <p>Le mail du premier utilisateur est : <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>Sa date d'inscription est le: <?php echo htmlspecialchars($date_inscription, ENT_QUOTES, 'UTF-8'); ?></p>
    <a class="btn btn-success" href="index.php?action=books" role="button">Découvrir</a>
</div>