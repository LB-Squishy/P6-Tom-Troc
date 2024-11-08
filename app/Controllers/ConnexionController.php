<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\UserManager;

class ConnexionController extends AbstractController
{
    /**
     * Affiche la page de connexion.
     * @return void
     */
    public function showConnexion(): void
    {
        $this->render("connexion", [], "Connexion");
    }
    /**
     * Connexion d'un utilisateur.
     * @return void
     */
    public function connexion(): void
    {
        $userManager = new UserManager();
        //Récupère les données du formulaire
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";
        //Vérifie les champs
        if (empty($email) || empty($password)) {
            $this->redirectWithMessage('error', 'Veuillez remplir tous les champs afin de vous connecter.', '/connexion');
        }
        //Récupère l'utilisateur
        $user = $userManager->getUserByEmail($email);
        //Vérifie l'utilisateur et son mot de passe
        if ($user && password_verify($password, $user->getPassword())) {
            //connexion réussi
            $_SESSION["user"] = $user;
            $this->redirectWithMessage('success', 'Connexion réussi. Bienvenue ' . $user->getPseudo() . ' !', '/mon-compte');
        } else {
            //Echec de connexion
            $this->redirectWithMessage('error', 'Echec de connexion. Veuillez saisir des identifiants corrects.', '/connexion');
        }
    }
    /**
     * Deconnexion d'un utilisateur.
     * @return void
     */
    public function deconnexion(): void
    {
        session_destroy();
        header('Location: /connexion');
        exit();
    }
}
