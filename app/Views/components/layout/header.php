<?php

/**
 * Template pour afficher le header'.
 */

// Vérifiez si l'utilisateur est connecté
$isLog = isset($_SESSION["user"]);
?>

<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=accueil">
                <img src="../../../src/images/logoTomTroc.png" alt="Logo" width="155" height="51" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="accueil">Accueil</a>
                    <a class="nav-link" href="nos-livres">Nos livres à l'échange</a>
                    <?php if ($isLog) : ?>
                        <a class="nav-link" href="messagerie">Messagerie</a>
                        <a class="nav-link" href="mon-compte">Mon compte</a>
                        <a class="nav-link" href="deconnexion">Déconnexion</a>
                    <?php else : ?>
                        <a class="nav-link" href="connexion">Connexion</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>
</header>