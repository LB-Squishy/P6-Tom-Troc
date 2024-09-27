<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class LivreController  extends AbstractController
{
    /**
     * Affiche la page de détail d'un Livre.
     * @return void
     */
    public function showLivre(): void
    {
        $this->render("Livre", [], "Titre du Livre");
        return;
    }
}
