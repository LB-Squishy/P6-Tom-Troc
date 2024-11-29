<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;

class LivreController  extends AbstractController
{
    /**
     * Affiche la page de détail d'un Livre.
     * @param int|null $book_id
     * @return void
     */
    public function showLivre(?int $book_id): void
    {
        $data = [];
        $bookManager = new BookManager();

        if ($book_id) {
            $data['book'] = $bookManager->getBookById($book_id);
            $this->render("Livre", $data, "Titre du Livre");
            return;
        }
    }
}
