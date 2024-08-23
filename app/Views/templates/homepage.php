<?php

/**
 * Template pour afficher la page d'accueil'.
 */
?>

<div class="container">
    <h1>Bienvenue sur la page d'<?= htmlspecialchars($title) ?></h1>
    <p>Le login du premier utilisateur est : <?php echo htmlspecialchars($login); ?></p>
    <a class="btn btn-success" href="index.php?action=books" role="button">Découvrir</a>
</div>