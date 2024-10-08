<?php

/**
 * Template pour afficher le header'.
 */

// Vérifiez si l'utilisateur est connecté
$isLog = isset($_SESSION["user"]);

// Détermine la page courante
$currentPage = basename($_SERVER["REQUEST_URI"], ".php")
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-background" style="height: 80px;">
        <div class="container-fluid navbar-background">
            <a class="navbar-brand" href="/accueil">
                <img src="../../../src/images/logoTomTroc.png" alt="Logo" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-background" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-background" id="navbarNavAltMarkup">
                <div class="navbar-nav text-end p-4">
                    <a class="nav-link <?= ($currentPage == "accueil") ? "active" : "" ?>" href="/accueil">Accueil</a>
                    <a class="nav-link <?= ($currentPage == "nos-livres") ? "active" : "" ?>" href="/nos-livres">Nos livres à l'échange</a>
                    <?php if ($isLog) : ?>
                        <a class="nav-link <?= ($currentPage == "messagerie") ? "active" : "" ?>" href="/messagerie">Messagerie</a>
                        <a class="nav-link <?= ($currentPage == "mon-compte") ? "active" : "" ?>" href="/mon-compte">Mon compte</a>
                        <a class="nav-link <?= ($currentPage == "deconnexion") ? "active" : "" ?>" href="/deconnexion">Déconnexion</a>
                    <?php else : ?>
                        <a class="nav-link <?= ($currentPage == "connexion") ? "active" : "" ?>" href="/connexion">Connexion</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>
</header>