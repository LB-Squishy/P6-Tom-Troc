<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class NosLivresController extends AbstractController
{
    /**
     * Affiche la page Nos Livres.
     * @return void
     */
    public function showNosLivres(): void
    {
        $this->render("nosLivres", [], "Nos livres à l'échange");
        return;
    }
}
