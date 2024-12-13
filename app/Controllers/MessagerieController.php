<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\ChatManager;
use App\Models\Managers\MessageManager;

class MessagerieController extends AbstractController
{
    /**
     * Affiche la page de messagerie.
     * @param int|null
     * @return void
     */
    public function showMessagerie(int $chat_id = null): void
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
        // Récupère les messages du chat si un chat_id est passé
        // var_dump($chat_id);
        if ($chat_id) {
            $messageManager = new MessageManager();
            $data['messages'] = $messageManager->getMessageByChatId($chat_id);
            // var_dump($data);
        }

        // Rend la page avec les données
        $this->render("messagerie", $data, "Messagerie");
        return;
    }
}
