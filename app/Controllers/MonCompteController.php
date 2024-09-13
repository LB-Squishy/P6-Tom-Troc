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

        if (!isset($_SESSION["user"])) {
            header('Location: error404');
            exit();
        }

        $this->render("monCompte", [], "Mon Compte");
    }
}
