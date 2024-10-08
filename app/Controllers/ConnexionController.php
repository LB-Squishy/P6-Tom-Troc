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

        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        if (!empty($email) && !empty($password)) {

            // Récupère l'utilisateur
            $user = $userManager->getUserByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION["user"] = $user;
                header('Location: /mon-compte');
                exit();
            } else {
                $error = "Echec de connexion";
            }
        }
        $this->render("connexion", ["error" => $error ?? ""], "Connexion non Valide");
        return;
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
