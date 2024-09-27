<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class MonCompteController extends AbstractController
{
    /**
     * Affiche la page Mon Compte.
     * @return void
     */
    public function showMonCompte(): void
    {

        $user = $_SESSION["user"] ?? null;
        $data = [];

        if ($user) {
            $data['email'] = $user->getEmail();
            $data['miniature_profil_url'] = $user->getMiniatureProfilUrl();
            $data['date_inscription'] = $user->getDateInscription();
        } else {
            header('Location: error404');
            exit();
        }

        $this->render("monCompte", $data, "Mon Compte");
        return;
    }
}
