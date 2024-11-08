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
            $this->redirectWithMessage('error', implode(' ', $errorMessages), '/inscription');
        }
        //Hash du mdp
        $password = password_hash($password, PASSWORD_BCRYPT);
        //Création l'entité User
        $user = new User();
        $user->setPseudo($pseudo);
        $user->setEmail($email);
        $user->setPassword($password);
        //Enregistre un nouvel User en BDD
        if (!$userManager->newUser($user)) {
            $this->redirectWithMessage('error', 'Echec de l\'inscription.', '/inscription');
        }
        //Rediriger avec success vers la page de connexion
        $this->redirectWithMessage('success', 'Bienvenue ' . $pseudo . '! , vous pouvez maintenant vous connecter à votre compte utilisateur.', '/connexion');
    }
}
