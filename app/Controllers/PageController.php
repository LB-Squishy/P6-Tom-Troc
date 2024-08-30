<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

require_once __DIR__ . '/../Models/Managers/UserManager.php';

class PageController extends AbstractController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $userManager = new UserManager();
        $user  = $userManager->find(1);
        $login = isset($user['login']) ? $user['login'] : 'Utilisateur non trouvé';

        $this->render("homepage", ['login' => $login], "Accueil");
    }

    /**
     * Affiche la page d'erreur 404.
     * @return void
     */
    public function showNotFound(): void
    {
        $this->render("Error404", [], "Page d'erreur 404");
    }
}
