<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\BookManager;
use App\Models\Managers\ChatManager;
use App\Models\Managers\MessageManager;
use App\Models\Entities\Message;
use App\Models\Entities\Chat;

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
     * Création d'un nouveau chat.
     * @return void
     */
    public function createChat(): void
    {
        // Valider l'utilisateur et récupérer son id
        $user = $this->checkUser();
        $data = ['id' => $user->getId()];
        // Initialiser les managers
        $chatManager = new ChatManager();
        // Récupérer les données
        $ownerId = $data['id'] ?? "";
        $participantId = intval($_GET["participant-id"] ?? "");
        $errorMessages = [];
        // Vérifier les champs
        if (empty($participantId)) {
            $this->redirectWithMessage('error', 'Participant introuvable.', '/messagerie');
        }
        if (!empty($errorMessages)) {
            $this->redirectWithMessage('error', implode(' ', $errorMessages), '/messagerie');
        }
        // Vérifier si un chat existe déjà entre les deux utilisateurs
        $chatId = $chatManager->getChatId($ownerId, $participantId);
        if ($chatId !== null) {
            $this->redirectWithMessage('', '', '/messagerie?chat_id=' . $chatId);
        }
        // Enregistrer un nouveau Chat en BDD et récupérer l'ID du chat
        $chatId = $chatManager->newChat($ownerId, $participantId);
        if ($chatId === null) {
            $this->redirectWithMessage('error', 'Echec de la création du chat.', '/messagerie');
        }
        // Rediriger avec succès vers la page de messagerie
        $this->redirectWithMessage('success', 'Chat créé ! ', '/messagerie?chat_id=' . $chatId);
    }

    /**
     * Supprime un chat.
     * @return void
     */
    public function deleteChat(): void
    {
        //Valider l'utilisateur
        $user = $this->checkUser();
        //Vérifie la présence de l'ID du chat
        $chat_id = $_GET['chat_id'] ?? null;
        if (empty($chat_id)) {
            $this->redirectWithMessage('error', 'ID du chat manquant.', '/messagerie');
        }
        //Récupère le chat à partir de l'ID
        $chatManager = new ChatManager();
        $chat = $chatManager->getChatById($chat_id);
        if (!$chat_id) {
            $this->redirectWithMessage('error', 'Chat introuvable.', '/messagerie');
        }
        //Vérifie que l'utilisateur est bien le propriétaire du chat
        if ($chat->getOwnerId() !== $user->getId()) {
            $this->redirectWithMessage('error', 'Action non autorisée. Vous n\'êtes pas le propriétaire de ce livre. Echec de suppression', '/messagerie');
        }
        //Supprime le chat
        $chatManager->deleteChatById($chat_id);
        $this->redirectWithMessage('success', 'Le chat a bien été supprimé.', '/messagerie');
    }

    /**
     * Envoi d'un message.
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
        $chat_id = intval($_GET["chat_id"]) ?? "";

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
