<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Entities\User;
use App\Models\Managers\UserManager;

class InscriptionController extends AbstractController
{
    /**
     * Affiche la page d'inscription.
     * @return void
     */
    public function showInscription(): void
    {
        $this->render("inscription", [], "Inscription");
    }
    /**
     * Inscription d'un nouvel utilisateur.
     * @return void
     */
    public function inscription(): void
    {
        $userManager = new UserManager();

        $pseudo = $_POST["pseudo"] ?? "";
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        if (!empty($pseudo) && !empty($email) && !empty($password)) {
            // Hash du mdp
            $password = password_hash($password, PASSWORD_BCRYPT);
            // Création entité USer
            $user = new User();
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($password);
            if ($userManager->newUser($user)) {
                header('Location: connexion');
                exit();
            } else {
                $error = "Echec de l'inscription";
            }
        }

        $this->render("inscription", ["error" => $error ?? ""], "Soumission d'inscription");
        return;
    }
}
