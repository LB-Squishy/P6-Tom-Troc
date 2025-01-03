<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\Managers\ChatManager;
use App\Models\Managers\MessageManager;
use App\Models\Entities\Message;
use App\Models\Entities\Chat;

class MessagerieController extends AbstractController
{
    /**
     * Affiche la page de messagerie.
     * @param int|null $chat_id
     * @param string|null $pseudo
     * @return void
     */
    public function showMessagerie(int $chat_id = null, string $pseudo = null): void
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
            var_dump($data);
            // Rend la page avec les données
            $this->render("messagerie", $data, "Messagerie");
            return;
        }
        // var_dump($data);

        // Va sur le bon chat si il y a deja un chat en cours ou créé un chat provisoire si ce n est pas le cas
        if ($pseudo) {
            // Récupère l'id du participant à partir du pseudo
            $participant_id = $chatManager->getParticipantIdByPseudo($pseudo);
            // Récupère l'id du chat si il existe
            $chat_id = $chatManager->getChatIdByParticipantsId($data['id'], $participant_id);

            // Si le chat n'existe pas, on le crée
            if ($chat_id === 0) {
                // création d'une valeur temporaire pour le chat
                $data['isTemp'] = true;
                // création du chat temporaire
                $chat = new Chat();
                $chat->setOwnerId($data['id']);
                $chat->setParticipantId($participant_id);
            } else {
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
            var_dump($data);
            // Rend la page avec les données
            $this->render("messagerie", $data, "Messagerie");
            return;
        }
        var_dump($data);

        // Rend la page avec les données
        $this->render("messagerie", $data, "Messagerie");
        return;
    }

    /**
     * Envoi d'un nouveau message.
     * @param int|null $chat_id
     * @return void
     */
    public function sendMessage(int $chat_id = null): void
    {
        //Valider l'utilisateur et récupère son id
        $user = $this->checkUser();
        $data = ['id' => $user->getId()];

        // Initialise les managers
        $chatManager = new ChatManager();
        $messageManager = new MessageManager();

        //Récupère les données du formulaire
        $messageContent = $_POST["new-message"] ?? "";
        $chat_id = $_GET["chat_id"] ?? "";
        $isTemp = $_GET["isTemp"] ?? null;
        $errorMessages = [];

        //Vérifie les champs
        if (empty($messageContent)) {
            $errorMessages[] = "Un message est requis.";
        }
        if (!empty($errorMessages)) {
            $this->redirectWithMessage('error', implode(' ', $errorMessages), '/messagerie?chat_id=' . $chat_id);
        }

        //Si le chat est temporaire, on le crée
        if ($isTemp) {
            $chat = new Chat();
            $chat->setOwnerId($data['id']);
            $chat->setParticipantId($_GET['participant_id']);
            //Enregistre un nouveau Chat en BDD
            $chat_id = $chatManager->getChatIdByParticipantsId($data['id'], $_GET['participant_id']);
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
