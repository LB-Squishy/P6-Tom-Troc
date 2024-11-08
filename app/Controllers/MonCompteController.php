<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;
use App\Models\Managers\UserManager;
use App\Services\Utils;

class MonCompteController extends AbstractController
{
    /**
     * Affiche la page Mon Compte.
     * @return void
     */
    public function showMonCompte(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();
        $data = [];

        // Récupère les données de l'utilisateur connecté
        $data = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'pseudo' => $user->getPseudo(),
            'miniature_profil_url' => $user->getMiniatureProfilUrl(),
            'date_inscription' => $user->getDateInscription(),
        ];
        // Récupère les livres de l'utilisateur connecté
        $bookManager = new BookManager();
        $data['books'] = $bookManager->getBookByUserId($user->getId());
        // Rend la page avec les données
        $this->render("monCompte", $data, "Mon Compte");
    }

    /**
     * Change la photo de profil.
     * @return void
     */
    public function editMiniature()
    {
        //Valider l'utilisateur
        $user = $this->checkUser();
        //Vérifie la méthode de la requête
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithMessage('error', 'Méthode non autorisée.', '/mon-compte');
        }
        // Vérifie la présence de la photo
        if (!isset($_FILES['photo'])) {
            $this->redirectWithMessage('error', 'Aucune photo n\'a été téléchargée.', '/mon-compte');
        }
        //Valider la photo
        $photo = $_FILES['photo'];
        $validationPhotoResponse = Utils::validatePhoto($photo);
        if ($validationPhotoResponse !== true) {
            $this->redirectWithMessage('error', $validationPhotoResponse, '/mon-compte');
        }
        //Sauvegarde la photo dans le dossier de destination
        $destination = dirname(__DIR__, 2) . '/src/images/uploads/profile/' . $photo['name'];
        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            $this->redirectWithMessage('error', 'Erreur lors du téléchargement de la photo.', '/mon-compte');
        }
        //Mettre à jour l'entité
        $user->setMiniatureProfilUrl($photo['name']);
        //Mettre à jour la BDD
        $userManager = new UserManager();
        $updateSuccess = $userManager->updateProfilePhoto($user);
        if (!$updateSuccess) {
            $this->redirectWithMessage('error', 'Erreur lors de la mise à jour de la photo dans la base de données.', '/mon-compte');
        }
        //Mettre à jour la session User et rediriger avec success
        $_SESSION["user"] = $user;
        $this->redirectWithMessage('success', 'Photo de profil mise à jour avec succès.', '/mon-compte');
    }

    /**
     * Met à jour les infos d'un utilisateur.
     * @return void
     */
    public function majInfosUtilisateur(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();
        //Récupère les données du formulaire
        $pseudo = $_POST["pseudo"] ?? "";
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";
        $errorMessages = [];
        //Vérifie les champs
        if (empty($pseudo)) {
            $errorMessages[] = "Un pseudo est requis.";
        }
        if (empty($email)) {
            $errorMessages[] = "Un email est requis.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessages[] = "L'email fourni est invalide.";
        }
        if (empty($password)) {
            $errorMessages[] = "Un mot de passe est requis.";
        } elseif (strlen($password) < 8) {
            $errorMessages[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        if (!empty($errorMessages)) {
            $this->redirectWithMessage('error', implode(' ', $errorMessages), '/mon-compte');
        }
        //Gèrer le mdp
        if (empty($password)) {
            //garde l'ancien mdp
            $password = $user->getPassword();
        } else {
            //hash le nouveau mdp
            $password = password_hash($password, PASSWORD_BCRYPT);
        }
        //Mettre à jour l'entité
        $user->setPseudo($pseudo);
        $user->setEmail($email);
        $user->setPassword($password);
        //Mettre à jour la BDD
        $userManager = new UserManager();
        $updateSuccess = $userManager->updateUser($user);
        if (!$updateSuccess) {
            $this->redirectWithMessage('error', 'Une erreur est survenue lors de la mise à jour de vos informations.', '/mon-compte');
        }
        //Mettre à jour la session User et rediriger avec success
        $_SESSION["user"] = $user;
        $this->redirectWithMessage('success', 'Vos informations ont été mises à jour avec succès.', '/mon-compte');
    }

    /**
     * Supprime un livre.
     * @return void
     */
    public function deleteLivre(): void
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
        $book = $bookManager->getBookById($book_id);
        if (!$book_id) {
            $this->redirectWithMessage('error', 'Livre introuvable.', '/mon-compte');
        }
        //Vérifie que l'utilisateur est bien le propriétaire du livre
        if ($book->getUserId() !== $user->getId()) {
            $this->redirectWithMessage('error', 'Action non autorisée. Vous n\'êtes pas le propriétaire de ce livre. Echec de suppression', '/mon-compte');
        }
        //Supprime le livre
        $bookManager->deleteBookById($book_id);
        $this->redirectWithMessage('success', 'Le livre a bien été supprimé.', '/mon-compte');
    }

    /**
     * Change la disponibilite d'un livre.
     * @return void
     */
    public function toggleDisponibiliteLivre(): void
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
        $book = $bookManager->getBookById($book_id);
        if (!$book_id) {
            $this->redirectWithMessage('error', 'Livre introuvable.', '/mon-compte');
        }
        //Vérifie que l'utilisateur est bien le propriétaire du livre
        if ($book->getUserId() !== $user->getId()) {
            $this->redirectWithMessage('error', 'Action non autorisée. Vous n\'êtes pas le propriétaire de ce livre. Echec de suppression', '/mon-compte');
        }
        //Change la disponibilité du livre
        $newDisponibilite = !$book->getDisponibilite();
        $bookManager->updateBookDispoById($book_id, $newDisponibilite);
        $this->redirectWithMessage('success', 'Disponibilité mise à jour avec succès.', '/mon-compte');
    }
}
