<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;

class NosLivresController extends AbstractController
{
    /**
     * Affiche la page nos livres.
     * @return void
     */
    public function showNosLivres(): void
    {
        $data = [];
        $bookManager = new BookManager();

        if (isset($_GET["rechercheLivre"]) && !empty(trim($_GET["rechercheLivre"]))) {
            $nomlivre = htmlspecialchars(trim($_GET["rechercheLivre"]), ENT_QUOTES, 'UTF-8');
            $data['books'] = $bookManager->getBookByTitle(16, $nomlivre);
        } else {
            $data['books'] = $bookManager->getLastBook(16);
        }

        $this->render("nosLivres", $data, "Nos livres à l'échange");
        return;
    }
}
