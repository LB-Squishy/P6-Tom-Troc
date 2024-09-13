<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class ComptePublicController extends AbstractController
{
    /**
     * Affiche la page Compte Public.
     * @return void
     */
    public function showComptePublic(): void
    {

        $this->render("comptePublic", [], "Compte Public");
    }
}
