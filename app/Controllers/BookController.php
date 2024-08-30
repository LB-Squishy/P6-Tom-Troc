<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

require_once __DIR__ . '/AbstractController.php';

class BookController extends AbstractController
{
    /**
     * Affiche les livres.
     * @return void
     */
    public function showBooks(): void
    {
        $this->render("books", [], "Nos Livres");
    }
}
