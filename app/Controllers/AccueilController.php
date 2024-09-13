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
            $data['email'] = $user['email'];
            $data['date_inscription'] = $user['date_inscription'];
        } else {
            $data['email'] = 'Non connecté';
            $data['date_inscription'] = 'Non disponible';
        }

        $this->render("accueil",  $data, "Rejoignez nos lecteurs passionés");
    }
}
