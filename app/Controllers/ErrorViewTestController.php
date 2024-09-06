<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class ErrorViewTestController extends AbstractController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showTest(): void
    {
        $userManager = new UserManager();
        $user = $userManager->find(1);

        if ($user) {
            $email = $user->getEmail();
            $date_inscription = $user->getDateInscription();
        } else {
            $email = 'Utilisateur non trouvé';
            $date_inscription = 'Date d\'inscription non trouvée';
        }

        $this->render("saperlipopette", ['email' => $email, 'date_inscription' => $date_inscription], "Accueil");
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
