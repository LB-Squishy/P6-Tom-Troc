<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class NotFoundController extends AbstractController
{
    /**
     * Affiche la page d'erreur 404.
     * @return void
     */
    public function showNotFound(): void
    {
        $this->render("Error404", [], "Page d'erreur 404");
        return;
    }
}
