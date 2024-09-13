<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class NosLivresController extends AbstractController
{
    /**
     * Affiche la page Nos Livres.
     * @return void
     */
    public function showNosLivres(): void
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

        $this->render("nosLivres", ['email' => $email, 'date_inscription' => $date_inscription], "Nos livres à l'échange");
    }
}
