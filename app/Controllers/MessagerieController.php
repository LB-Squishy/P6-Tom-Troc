<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class MessagerieController extends AbstractController
{
    /**
     * Affiche la page de messagerie.
     * @return void
     */
    public function showMessagerie(): void
    {

        if (!isset($_SESSION["user"])) {
            header('Location: error404');
            exit();
        }

        $this->render("messagerie", [], "Messagerie");
        return;
    }
}
