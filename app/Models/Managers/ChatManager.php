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
        WHERE c.owner_id = :user_id OR c.participant_id = :user_id 
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

    // Récupère l'ID du participant à partir du pseudo
    public function getParticipantIdByPseudo(string $pseudo): int
    {
        $stmt = $this->db->prepare("
        SELECT id
        FROM users
        WHERE pseudo = :pseudo
        ");
        $stmt->execute(['pseudo' => $pseudo]);
        $data = $stmt->fetch();
        return $data['id'];
    }

    // Récupère l'ID du chat à partir des ID des participants
    public function getChatIdByParticipantsId(int $owner_id, int $participant_id): int
    {
        $stmt = $this->db->prepare("
        SELECT id
        FROM {$this->table}
        WHERE owner_id = :owner_id AND participant_id = :participant_id
        ");
        $stmt->execute(['owner_id' => $owner_id, 'participant_id' => $participant_id]);
        $data = $stmt->fetch();
        if (!$data) {
            return 0;
        }
        return $data['id'];
    }
}
