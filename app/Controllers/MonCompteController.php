<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;

class MonCompteController extends AbstractController
{
    /**
     * Affiche la page Mon Compte.
     * @return void
     */
    public function showMonCompte(): void
    {

        $user = $_SESSION["user"] ?? null;
        $data = [];

        if ($user) {
            $data['id'] = $user->getId();
            $data['email'] = $user->getEmail();
            $data['pseudo'] = $user->getPseudo();
            $data['miniature_profil_url'] = $user->getMiniatureProfilUrl();
            $data['date_inscription'] = $user->getDateInscription();

            // Récupère les livres de l'utilisateur connecté
            $bookManager = new BookManager();
            $data['books'] = $bookManager->getBookByUserId($user->getId());
        } else {
            header('Location: error404');
            exit();
        }
        $this->render("monCompte", $data, "Mon Compte");
        return;
    }

    /**
     * Supprime un livre.
     * @return void
     */
    public function deleteLivre(): void
    {
        $user = $_SESSION["user"] ?? null;
        if ($user) {
            $book_id = $_GET['book_id'] ?? null;
            if ($book_id) {
                $bookManager = new BookManager();
                $bookManager->deleteBookByBookId($book_id);
            }
            header('Location: /mon-compte');
            exit();
        } else {
            header('Location: error404');
            exit();
        }
    }
}
