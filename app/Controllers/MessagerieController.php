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
            $chatManager->resetUnreadCount($chat_id, $data['id']);
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
        $chatManager = new ChatManager();
        //Récupère les données du formulaire
        $messageContent = $_POST["new-message"] ?? "";
        $chat_id = intval($_GET["chat_id"]) ?? "";
        // Récupère l'ID du participant
        $chat = $chatManager->getChatById($chat_id);
        $participant_id = $chat->getParticipantId();
        // Récupère les deux chats distincts pour l'owner et le participant
        $chatOwner = $chatManager->getChatId($data['id'], $participant_id);
        $chatParticipant = $chatManager->getChatId($participant_id, $data['id']);
        //Création l'entité Message pour l'Owner
        $messageOwner = new Message();
        $messageOwner->setChatId($chatOwner);
        $messageOwner->setSenderId($data['id']);
        $messageOwner->setMessage($messageContent);
        //Création l'entité Message pour le participant
        $messageParticipant = new Message();
        $messageParticipant->setChatId($chatParticipant);
        $messageParticipant->setSenderId($participant_id);
        $messageParticipant->setMessage($messageContent);
        //Enregistre un nouveau Message en BDD
        $messageManager->newMessage($messageOwner);
        $messageManager->newMessage($messageParticipant);
        //Incrementer le compteur de message non lu du participant
        $chatManager->incrementUnreadCount($chatParticipant, $participant_id);
        //Rediriger avec success vers la page de messagerie
        $this->redirectWithMessage('success', 'Message envoyé ! ' . $chatParticipant . ' ' . $participant_id, '/messagerie?chat_id=' . $chat_id);
    }
}
