<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class AccueilController extends AbstractController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showAccueil(): void
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

        $this->render("accueil", ['email' => $email, 'date_inscription' => $date_inscription], "Rejoignez nos lecteurs passionés");
    }
}
