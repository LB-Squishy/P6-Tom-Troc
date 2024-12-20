<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\ChatManager;
use App\Models\Managers\MessageManager;
use App\Models\Entities\Message;

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
            foreach ($data['chats'] as $chat) {
                if ($chat->getId() === $chat_id) {
                    $data['currentParticipant'] =
                        [
                            'pseudoParticipant' => $chat->getParticipantPseudo(),
                            'miniatureParticipant' => $chat->getParticipantMiniature(),
                        ];
                    break;
                }
            }
        }
        // var_dump($data);

        // Rend la page avec les données
        $this->render("messagerie", $data, "Messagerie");
        return;
    }

    /**
     * Inscription d'un nouvel utilisateur.
     * @param int|null $chat_id
     * @return void
     */
    public function sendMessage(int $chat_id = null): void
    {
        //Valider l'utilisateur et récupère son id
        $user = $this->checkUser();
        $data = ['id' => $user->getId()];
        // Initialise les managers
        $messageManager = new MessageManager();
        //Récupère les données du formulaire
        $messageContent = $_POST["new-message"] ?? "";
        $chat_id = $_GET["chat_id"] ?? "";
        $errorMessages = [];
        //Vérifie les champs
        if (empty($messageContent)) {
            $errorMessages[] = "Un message est requis.";
        }
        if (!empty($errorMessages)) {
            $this->redirectWithMessage('error', implode(' ', $errorMessages), '/messagerie?chat_id=' . $chat_id);
        }
        //Création l'entité Message
        $message = new Message();
        $message->setChatId($chat_id);
        $message->setSenderId($data['id']);
        $message->setMessage($messageContent);
        //Enregistre un nouveau Message en BDD
        if (!$messageManager->newMessage($message)) {
            $this->redirectWithMessage('error', 'Echec de l\'envoi.', '/messagerie?chat_id=' . $chat_id);
        }
        //Rediriger avec success vers la page de messagerie
        $this->redirectWithMessage('success', 'Message envoyé ! ', '/messagerie?chat_id=' . $chat_id);
    }
}
