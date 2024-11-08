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

    public function editMiniature()
    {
        //Valider l'utilisateur
        $user = $this->checkUser();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
            $photo = $_FILES['photo'];
            //Valider la photo
            $validationPhotoResponse = Utils::validatePhoto($photo);
            // Enregistrer la photo si elle est valide
            if ($validationPhotoResponse === true) {
                $destination = dirname(__DIR__, 2) . '/src/images/uploads/profile/' . $photo['name'];
                if (move_uploaded_file($photo['tmp_name'], $destination)) {
                    $user->setMiniatureProfilUrl($photo['name']);
                    $userManager = new UserManager();
                    $updateSuccess = $userManager->updateProfilePhoto($user);
                    if ($updateSuccess) {
                        $_SESSION["user"] = $user;
                        $this->redirectWithMessage('success', 'Photo de profil mise à jour avec succès.', '/mon-compte');
                    } else {
                        $this->redirectWithMessage('error', 'Erreur lors de la mise à jour de la photo dans la base de données.', '/mon-compte');
                    }
                } else {
                    $this->redirectWithMessage('error', 'Erreur lors du téléchargement de la photo.', '/mon-compte');
                }
            } else {
                $this->redirectWithMessage('error', $validationPhotoResponse, '/mon-compte');
            }
        }
    }

    /**
     * Met à jour les infos d'un utilisateur.
     * @return void
     */
    public function majInfosUtilisateur(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();

        $pseudo = $_POST["pseudo"] ?? "";
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";
        if (!empty($pseudo) && !empty($email)) {
            if ($password === "") {
                //garde l'ancien mdp
                $password = $user->getPassword();
            } else {
                //hash le nouveau mdp
                $password = password_hash($password, PASSWORD_BCRYPT);
            }
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($password);
            $userManager = new UserManager();
            $updateSuccess = $userManager->updateUser($user);
            if ($updateSuccess) {
                $_SESSION["user"] = $user;
                $this->redirectWithMessage('success', 'Vos informations ont été mises à jour avec succès.', '/mon-compte');
            } else {
                $this->redirectWithMessage('error', 'Une erreur est survenue lors de la mise à jour de vos informations.', '/mon-compte');
            }
        } else {
            $this->redirectWithMessage('error', 'Veuillez compléter tout les champs.', '/mon-compte');
        }
    }

    /**
     * Supprime un livre.
     * @return void
     */
    public function deleteLivre(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();

        // Récupère l'id du livre depuis la requête
        $book_id = $_GET['book_id'] ?? null;
        if ($book_id) {
            $bookManager = new BookManager();
            // Récupère le livre depuis l'id fourni
            $book = $bookManager->getBookById($book_id);
            // Contrôle le fait que l'utilisateur est bien le propriétaire du livre
            if ($book && $book->getUserId() === $user->getId()) {
                $bookManager->deleteBookById($book_id);
                $this->redirectWithMessage('success', 'Le livre a bien été supprimé.', '/mon-compte');
            } else {
                $this->redirectWithMessage('error', 'Livre introuvable ou non autorisé. Echec de suppression', '/mon-compte');
            }
        }
    }

    /**
     * Change la disponibilite d'un livre.
     * @return void
     */
    public function toggleDisponibiliteLivre(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();

        // Récupère l'id du livre depuis la requête
        $book_id = $_GET['book_id'] ?? null;
        if ($book_id) {
            $bookManager = new BookManager();
            $book = $bookManager->getBookById($book_id);
            if ($book && $book->getUserId() === $user->getId()) {
                $newDisponibilite = !$book->getDisponibilite();
                $bookManager->updateBookDispoById($book_id, $newDisponibilite);
                $this->redirectWithMessage('success', 'Disponibilité mise à jour avec succès.', '/mon-compte');
            } else {
                $this->redirectWithMessage('error', 'Livre introuvable ou non autorisé. Echec de mise à jour', '/mon-compte');
            }
        }
    }
}
