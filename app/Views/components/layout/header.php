<?php

/**
 * Template pour afficher le header.
 */

use App\Models\Managers\ChatManager;

// Vérifiez si l'utilisateur est connecté
$isLog = isset($_SESSION["user"]);

// Détermine la page courante
$currentPage = basename($_SERVER["REQUEST_URI"], ".php")
?>

<header>
    <a href="/accueil">
        <img src="../../../src/images/logoTomTroc.png" alt="Logo">
    </a>
    <nav class="navbar">
        <ul class="navbar__container">
            <li>
                <a class="navbar__container--link <?= ($currentPage == "accueil") ? "active" : "" ?>" href="/accueil">Accueil</a>
            </li>
            <li>
                <a class="navbar__container--link <?= ($currentPage == "nos-livres") ? "active" : "" ?>" href="/nos-livres">Nos livres à l'échange</a>
            </li>
        </ul>
        <ul class="navbar__container">
            <?php if ($isLog) : ?>
                <li>
                    <a class="navbar__container--link <?= ($currentPage == "messagerie") ? "active" : "" ?>" href="/messagerie">
                        <i class="fa-regular fa-comment"></i>
                        <p>Messagerie</p>
                        <div class="counterPill">
                            <p>
                                <?php
                                $total_non_lu = (new ChatManager())->getTotalUnreadCount($_SESSION['user']->getId());
                                echo $total_non_lu
                                ?>
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="navbar__container--link <?= ($currentPage == "mon-compte") ? "active" : "" ?>" href="/mon-compte">
                        <i class="fa-regular fa-user"></i>
                        <p>Mon compte</p>
                    </a>
                </li>
                <li>
                    <a class="navbar__container--link <?= ($currentPage == "deconnexion") ? "active" : "" ?>" href="/deconnexion">Déconnexion</a>
                </li>
            <?php else : ?>
                <li>
                    <a class="navbar__container--link <?= ($currentPage == "connexion") ? "active" : "" ?>" href="/connexion">Connexion</a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</header>