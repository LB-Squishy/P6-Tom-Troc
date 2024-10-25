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
            header('Location: /error404');
            exit();
        }
        $this->render("monCompte", $data, "Mon Compte");
        return;
    }

    public function editMiniature()
    {
        $user = $_SESSION["user"] ?? null;

        if ($user) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
                $photo = $_FILES['photo'];

                // Valider le fichier
                if (Utils::validatePhoto($photo)) {
                    $destination = dirname(__DIR__, 2) . '/src/images/uploads/profile/' . $photo['name'];
                    if (move_uploaded_file($photo['tmp_name'], $destination)) {
                        $user->setMiniatureProfilUrl($photo['name']);

                        $userManager = new UserManager();
                        $updateSuccess = $userManager->updateProfilePhoto($user);

                        if ($updateSuccess) {
                            $_SESSION["user"] = $user;
                            $_SESSION['success'] = 'Photo de profil mise à jour avec succès.'; // Ajout d'un message de succès
                            header('Location: /mon-compte');
                            exit();
                        } else {
                            // Gérer l'erreur de mise à jour en BDD
                            header('Location: /mon-compte');
                            $_SESSION['error'] = 'Erreur lors de la mise à jour de la photo dans la base de données.';
                        }
                    } else {
                        // Gérer l'erreur d'upload
                        header('Location: /mon-compte');
                        $_SESSION['error'] = 'Erreur lors de l\'upload de la photo.';
                    }
                } else {
                    header('Location: /mon-compte');
                    $_SESSION['error'] = 'La photo sélectionnée n\'est pas valide.';
                }
            }
        } else {
            // Afficher un message d'erreur si l'utilisateur n'est pas connecté
            header('Location: /mon-compte');
            $_SESSION['error'] = 'Vous devez être connecté pour modifier votre photo de profil.';
        }

        // Renvoyer à la vue courante pour afficher les erreurs
        header('Location: /mon-compte');
        exit();
    }

    /**
     * Met à jour les infos d'un utilisateur.
     * @return void
     */
    public function majInfosUtilisateur(): void
    {
        $user = $_SESSION["user"] ?? null;

        if ($user) {

            $pseudo = $_POST["pseudo"] ?? "";
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";

            if (!empty($pseudo) && !empty($email) && !empty($password)) {
                if ($password === "••••••••••") {
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
                    header('Location: /mon-compte');
                    exit();
                } else {
                    $error = "Une erreur est survenue lors de la mise à jour.";
                    $this->render("monCompte", ["error" => $error ?? ""], "Mon Compte");
                }
            } else {
                $error = "Veuillez compléter tout les champs.";
                $this->render("monCompte", ["error" => $error ?? ""], "Mon Compte");
            }
        } else {
            header('Location: /connexion');
            exit();
        }
    }

    /**
     * Supprime un livre.
     * @return void
     */
    public function deleteLivre(): void
    {
        $user = $_SESSION["user"] ?? null;

        if ($user) {
            // Récupère l'id du livre depuis la requête
            $book_id = $_GET['book_id'] ?? null;

            if ($book_id) {
                $bookManager = new BookManager();
                // Récupère le livre depuis l'id fourni
                $book = $bookManager->getBookById($book_id);

                // Contrôle le fait que l'utilisateur est bien le propriétaire du livre
                if ($book && $book->getUserId() === $user->getId()) {
                    $bookManager->deleteBookById($book_id);
                    header('Location: /mon-compte');
                    exit();
                } else {
                    header('Location: /error404');
                    exit();
                }
            }
        } else {
            header('Location: /error404');
            exit();
        }
    }

    /**
     * Change la disponibilite d'un livre.
     * @return void
     */
    public function toggleDisponibiliteLivre(): void
    {
        $user = $_SESSION["user"] ?? null;

        if ($user) {
            // Récupère l'id du livre depuis la requête
            $book_id = $_GET['book_id'] ?? null;

            if ($book_id) {
                $bookManager = new BookManager();
                // Récupère le livre depuis l'id fourni
                $book = $bookManager->getBookById($book_id);

                // Contrôle le fait que l'utilisateur est bien le propriétaire du livre
                if ($book && $book->getUserId() === $user->getId()) {
                    $newDisponibilite = !$book->getDisponibilite();
                    $bookManager->updateBookDispoById($book_id, $newDisponibilite);
                    header('Location: /mon-compte');
                    exit();
                } else {
                    header('Location: /error404');
                    exit();
                }
            }
        } else {
            header('Location: /error404');
            exit();
        }
    }
}
