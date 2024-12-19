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
        //Valider l'utilisateur et récupère son id
        $user = $this->checkUser();
        $data = ['id' => $user->getId()];
        // Initialise les managers
        $chatManager = new ChatManager();
        $messageManager = new MessageManager();

        // Récupère les chats de l'utilisateur connecté
        $data['chats'] = $chatManager->getChatsByUserId($user->getId());
        //Récupère les derniers messages de chaque chats
        foreach ($data['chats'] as $chat) {
            $last_message = $messageManager->getLastMessageByChatId($chat->getId());
            $chat->setLastMessage($last_message);
        }
        // Récupère les messages du chat si un chat_id est passé
        if ($chat_id) {
            $data['messages'] = $messageManager->getMessageByChatId($chat_id);
            $data['currentChat'] = $chat_id;
        }

        // Rend la page avec les données
        $this->render("messagerie", $data, "Messagerie");
        return;
    }
}
