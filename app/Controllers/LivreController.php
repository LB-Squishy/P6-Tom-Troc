<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class LivreController  extends AbstractController
{
    /**
     * Affiche la page de détail d'un Livre.
     * @return void
     */
    public function showLivre(): void
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

        $this->render("Livre", ['email' => $email, 'date_inscription' => $date_inscription], "Titre du Livre");
    }
}
