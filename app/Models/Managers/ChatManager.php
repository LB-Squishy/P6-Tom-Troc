<?php

namespace App\Models\Managers;

use App\Models\Entities\Chat;
use App\Models\Managers\AbstractManager;

class ChatManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'chats';
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = Chat::class;
    }

    // Récupère un historique de chat par l'id de l'utilisateur connecté
    public function getChatsByUserId(int $user_id): array
    {
        $stmt = $this->db->prepare("
        SELECT 
            c.*,
            u1.miniature_profil_url AS owner_miniature,
            u1.pseudo AS owner_pseudo,
            u2.miniature_profil_url AS participant_miniature,
            u2.pseudo AS participant_pseudo
        FROM {$this->table} c
        LEFT JOIN users u1 ON u1.id = c.owner_id
        LEFT JOIN users u2 ON u2.id = c.participant_id
        WHERE c.owner_id = :user_id
        ORDER BY date_creation DESC
        ");
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetchAll();

        $chats = [];
        if ($data && $this->entityClass) {
            foreach ($data as $chatData) {
                $chat = new $this->entityClass($chatData);
                $chat->setOwnerMiniature($chatData['owner_miniature']);
                $chat->setOwnerPseudo($chatData['owner_pseudo']);
                $chat->setParticipantMiniature($chatData['participant_miniature']);
                $chat->setParticipantPseudo($chatData['participant_pseudo']);
                $chats[] = $chat;
            }
            return $chats;
        }
        return [];
    }

    //Récupère l'Id d'un chat
    public function getChatId(int $owner_id, int $participant_id): ?int
    {
        $stmt = $this->db->prepare("
        SELECT id
        FROM {$this->table}
        WHERE owner_id = :owner_id AND participant_id = :participant_id
        ");
        $stmt->execute(['owner_id' => $owner_id, 'participant_id' => $participant_id]);
        $data = $stmt->fetch();
        return $data ? $data['id'] : null;
    }

    //Crée un nouveau chat
    public function newChat(int $owner_id, int $participant_id): ?int
    {
        $dataOwner = [
            "owner_id" => $owner_id,
            "participant_id" => $participant_id,
        ];

        $dataParticipant = [
            "owner_id" => $participant_id,
            "participant_id" => $owner_id,
        ];

        if ($this->create($dataOwner)) {
            $ownerChatId = (int)$this->db->lastInsertId();
            if ($this->create($dataParticipant)) {
                return $ownerChatId;
            }
        }

        return null;
    }

    //Récupère un chat par son id
    public function getChatById(int $chat_id): ?Chat
    {
        $stmt = $this->db->prepare("
        SELECT 
            c.*,
            u1.miniature_profil_url AS owner_miniature,
            u1.pseudo AS owner_pseudo,
            u2.miniature_profil_url AS participant_miniature,
            u2.pseudo AS participant_pseudo
        FROM {$this->table} c
        LEFT JOIN users u1 ON u1.id = c.owner_id
        LEFT JOIN users u2 ON u2.id = c.participant_id
        WHERE c.id = :chat_id
        ");
        $stmt->execute(['chat_id' => $chat_id]);
        $data = $stmt->fetch();

        if ($data && $this->entityClass) {
            $chat = new $this->entityClass($data);
            $chat->setOwnerMiniature($data['owner_miniature']);
            $chat->setOwnerPseudo($data['owner_pseudo']);
            $chat->setParticipantMiniature($data['participant_miniature']);
            $chat->setParticipantPseudo($data['participant_pseudo']);
            return $chat;
        }
        return null;
    }

    // Supprime un chat par son id
    public function deleteChatById(int $chat_id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :chat_id");
        $stmt->execute(['chat_id' => $chat_id]);
    }

    // Recupère le comptage de message non lu
    public function getTotalUnreadCount(int $user_id): int
    {
        $stmt = $this->db->prepare("
            SELECT SUM(participant_non_lu) AS total_non_lu
            FROM {$this->table} 
            WHERE owner_id = :user_id
        ");
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetch();
        return $data ? (int)$data['total_non_lu'] : 0;
    }

    // Incrémente le comptage de message non lu
    public function incrementUnreadCount(int $chat_id, int $participant_id): void
    {
        $stmt = $this->db->prepare("
        UPDATE {$this->table}
        SET participant_non_lu = participant_non_lu + 1
        WHERE id = :chat_id
            AND owner_id = :participant_id
        ");
        $stmt->execute(['chat_id' => $chat_id, 'participant_id' => $participant_id]);
    }

    // Réinitialise le comptage des messages non lus pour le participant
    public function resetUnreadCount(int $chat_id, int $user_id): void
    {
        $stmt = $this->db->prepare("
        UPDATE {$this->table}
        SET participant_non_lu = 0
        WHERE id = :chat_id AND owner_id = :owner_id
    ");
        $stmt->execute(['chat_id' => $chat_id, 'owner_id' => $user_id]);
    }
}
