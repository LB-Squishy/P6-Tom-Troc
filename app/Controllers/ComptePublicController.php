<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;
use App\Models\Managers\UserManager;

class ComptePublicController extends AbstractController
{
    /**
     * Affiche la page Compte Public.
     * @param string|null $pseudo
     * @return void
     */
    public function showComptePublic(?string $pseudo): void
    {

        $userManager = new UserManager();
        $data = [];

        if ($pseudo) {
            $user = $userManager->getUserByPseudo($pseudo);
            if ($user) {
                $data['email'] = $user->getEmail();
                $data['pseudo'] = $user->getPseudo();
                $data['date_inscription'] = $user->getDateInscription();
                $data['miniature_profil_url'] = $user->getMiniatureProfilUrl();
            }
            // Récupère les livres de l'utilisateur connecté
            $bookManager = new BookManager();
            $data['books'] = $bookManager->getBookByUserId($user->getId());
            $this->render("comptePublic", $data, "Compte Public");
            return;
        }
    }
}
