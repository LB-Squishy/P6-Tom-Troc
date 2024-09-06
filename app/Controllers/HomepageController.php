<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class HomepageController extends AbstractController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHomepage(): void
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

        $this->render("homepage", ['email' => $email, 'date_inscription' => $date_inscription], "Accueil");
    }
}
