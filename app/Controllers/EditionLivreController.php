<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class EditionLivreController  extends AbstractController
{
    /**
     * Affiche la page d'édition d'un Livre.
     * @return void
     */
    public function showEditionLivre(): void
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

        $this->render("editionLivre", ['email' => $email, 'date_inscription' => $date_inscription], "Modifier les informations");
    }
}
