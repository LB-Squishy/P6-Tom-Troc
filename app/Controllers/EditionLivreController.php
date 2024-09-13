<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class EditionLivreController  extends AbstractController
{
    /**
     * Affiche la page d'édition d'un Livre.
     * @return void
     */
    public function showEditionLivre(): void
    {
        if (!isset($_SESSION["user"])) {
            header('Location: error404');
            exit();
        }

        $this->render("editionLivre", [], "Modifier les informations");
    }
}
