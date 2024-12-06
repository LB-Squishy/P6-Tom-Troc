<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;
use App\Models\Managers\UserManager;
use App\Services\Utils;

class EditionLivreController extends AbstractController
{
    /**
     * Affiche la page d'édition d'un Livre.
     * @return void
     */
    public function showEditionLivre(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();
        //Vérifie la présence de l'ID du livre dans la requête
        $book_id = $_GET['book_id'] ?? null;
        if (empty($book_id)) {
            $this->redirectWithMessage('error', 'ID du livre manquant.', '/mon-compte');
        }
        //Récupère le livre à partir de l'ID
        $bookManager = new BookManager();
        $data['book'] = $bookManager->getBookById($book_id);
        if (!$book_id) {
            $this->redirectWithMessage('error', 'Livre introuvable.', '/mon-compte');
        }
        //Vérifie que l'utilisateur est bien le propriétaire du livre
        if ($data['book']->getUserId() !== $user->getId()) {
            $this->redirectWithMessage('error', 'Action non autorisée. Vous n\'êtes pas le propriétaire de ce livre.', '/mon-compte');
        }
        //Render la page
        $this->render("editionLivre", $data, "Modifier les informations");
        return;
    }

    /**
     * Change la couverture d'un livre.
     * @return void
     */
    public function editBookCover()
    {
        // Valider l'utilisateur
        $user = $this->checkUser();
        // Vérifie la méthode de la requête
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithMessage('error', 'Méthode non autorisée.', '/mon-compte');
        }
        // Vérifie la présence de l'ID du livre dans la requête
        $book_id = $_POST['book_id'] ?? null;
        if (empty($book_id)) {
            $this->redirectWithMessage('error', 'ID du livre manquant.', '/mon-compte');
        }
        // Récupère le livre à partir de l'ID
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($book_id);
        if (!$book) {
            $this->redirectWithMessage('error', 'Livre introuvable.', '/mon-compte');
        }
        // Vérifie que l'utilisateur est bien le propriétaire du livre
        if ($book->getUserId() !== $user->getId()) {
            $this->redirectWithMessage('error', 'Action non autorisée. Vous n\'êtes pas le propriétaire de ce livre.', '/mon-compte');
        }
        // Vérifie la présence de la couverture
        if (!isset($_FILES['bookCover'])) {
            $this->redirectWithMessage('error', 'Aucune photo n\'a été téléchargée ou erreur de téléchargement.', '/edition-livre?book_id=' . $book_id);
        }
        // Valider la couverture
        $cover = $_FILES['bookCover'];
        $validationPhotoResponse = Utils::validateCover($cover);
        if ($validationPhotoResponse !== true) {
            $this->redirectWithMessage('error', $validationPhotoResponse, '/edition-livre?book_id=' . $book_id);
        }
        // Sauvegarde la photo dans le dossier de destination
        $destination = dirname(__DIR__, 2) . '/src/images/uploads/book/' . $cover['name'];
        if (!move_uploaded_file($cover['tmp_name'], $destination)) {
            $this->redirectWithMessage('error', 'Erreur lors du téléchargement de la photo.', '/edition-livre?book_id=' . $book_id);
        }
        // Mettre à jour la couverture du livre
        $book->setImageUrl($cover['name']);
        // Mettre à jour la BDD
        $updateSuccess = $bookManager->updateBookCover($book);
        if (!$updateSuccess) {
            $this->redirectWithMessage('error', 'Erreur lors de la mise à jour de la couverture dans la base de données.', '/edition-livre?book_id=' . $book_id);
        }
        // Rediriger avec succès
        $this->redirectWithMessage('success', 'Couverture du livre mise à jour avec succès.', '/edition-livre?book_id=' . $book_id);
    }

    /**
     * Met à jour les infos d'un livre.
     * @return void
     */
    public function majInfosLivre(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();
        // Vérifie la méthode de la requête
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithMessage('error', 'Méthode non autorisée.', '/mon-compte');
        }
        // Vérifie la présence de l'ID du livre dans la requête
        $book_id = $_POST['book_id'] ?? null;
        if (empty($book_id)) {
            $this->redirectWithMessage('error', 'ID du livre manquant.', '/mon-compte');
        }
        // Récupère le livre à partir de l'ID
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($book_id);
        if (!$book) {
            $this->redirectWithMessage('error', 'Livre introuvable.', '/mon-compte');
        }
        // Vérifie que l'utilisateur est bien le propriétaire du livre
        if ($book->getUserId() !== $user->getId()) {
            $this->redirectWithMessage('error', 'Action non autorisée. Vous n\'êtes pas le propriétaire de ce livre.', '/mon-compte');
        }
        //Récupère les données du formulaire
        $titre = $_POST["titre"] ?? "";
        $auteur = $_POST["auteur"] ?? "";
        $commentaire = $_POST["commentaire"] ?? "";
        $disponibilite = isset($_POST['disponibilite']) ? (int) $_POST['disponibilite'] : null;
        $errorMessages = [];
        //Vérifie les champs
        if (empty($titre)) {
            $errorMessages[] = "Un titre est requis.";
        }
        if (empty($auteur)) {
            $errorMessages[] = "Un auteur est requis.";
        }
        if (empty($commentaire)) {
            $errorMessages[] = "Un commentaire est requis.";
        }
        if ($disponibilite === null) {
            $errorMessages[] = "La disponibilité est requise.";
        }
        //Gestion des erreurs du formulaire
        if (!empty($errorMessages)) {
            $this->redirectWithMessage('error', implode(' ', $errorMessages), '/edition-livre?book_id=' . $book_id);
        }
        //Mettre à jour l'entité
        $book->setTitre($titre);
        $book->setAuteur($auteur);
        $book->setDescription($commentaire);
        $book->setDisponibilite($disponibilite);
        //Mettre à jour la BDD
        $bookManager = new bookManager();
        $updateSuccess = $bookManager->updateBookById($book_id, $book);
        if (!$updateSuccess) {
            $this->redirectWithMessage('error', 'Une erreur est survenue lors de la mise à jour du livre.', '/edition-livre?book_id=' . $book_id);
        }
        //Mettre à jour la session User et rediriger avec success
        $this->redirectWithMessage('success', 'Les informations du livre ont été mises à jour avec succès.', '/edition-livre?book_id=' . $book_id);
    }
}
