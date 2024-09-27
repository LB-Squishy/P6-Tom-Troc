<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showAccueil(): void
    {
        $user = $_SESSION["user"] ?? null;
        $data = [];

        if ($user) {
            $data['email'] = $user->getEmail();
            $data['miniature_profil_url'] = $user->getMiniatureProfilUrl();
            $data['date_inscription'] = $user->getDateInscription();
        } else {
            $data['email'] = 'Non connecté';
            $data['miniature_profil_url'] = 'Non disponible';
            $data['date_inscription'] = 'Non disponible';
        }

        $this->render("accueil", $data, "Rejoignez nos lecteurs passionés");
        return;
    }
}
