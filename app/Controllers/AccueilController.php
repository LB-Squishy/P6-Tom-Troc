<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;

class AccueilController extends AbstractController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showAccueil(): void
    {
        $data = [];

        // Récupère les 4 derniers livres
        $bookManager = new BookManager();
        $data['books'] = $bookManager->getLastBook(4);

        $this->render("accueil", $data, "Rejoignez nos lecteurs passionés");
        return;
    }
}
