<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class ConnexionController extends AbstractController
{
    /**
     * Affiche la page de connexion.
     * @return void
     */
    public function showConnexion(): void
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

        $this->render("connexion", ['email' => $email, 'date_inscription' => $date_inscription], "Connexion");
    }
}
