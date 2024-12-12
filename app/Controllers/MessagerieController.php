<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\ChatManager;

class MessagerieController extends AbstractController
{
    /**
     * Affiche la page de messagerie.
     * @return void
     */
    public function showMessagerie(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();
        $data = [];

        // Récupère les données de l'utilisateur connecté
        $data = [
            'id' => $user->getId(),
        ];
        // Récupère les chats de l'utilisateur connecté
        $chatManager = new ChatManager();
        $data['chats'] = $chatManager->getChatsByUserId($user->getId());
        // Rend la page avec les données
        $this->render("messagerie", $data, "Messagerie");
        return;
    }
}
