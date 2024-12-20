<?php

namespace App\Models\Managers;

use App\Models\Entities\Message;
use App\Models\Managers\AbstractManager;

class MessageManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'messages';
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = Message::class;
    }

    // Récupère la liste des message par l'Id d'un chat
    public function getMessageByChatId(int $chat_id): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                m.chat_id,
                m.sender_id,
                m.message,
                m.date_envoi,
                u.miniature_profil_url AS sender_miniature
            FROM {$this->table} m
            LEFT JOIN users u ON m.sender_id = u.id
            WHERE m.chat_id = :chat_id
            ORDER BY m.date_envoi ASC
            ");
        $stmt->execute(['chat_id' => $chat_id]);
        $data = $stmt->fetchAll();

        $messages = [];
        if ($data && $this->entityClass) {
            foreach ($data as $messageData) {
                $message = new $this->entityClass($messageData);
                $message->setChatId($messageData['chat_id']);
                $message->setSenderId($messageData['sender_id']);
                $message->setMessage($messageData['message']);
                $message->setDateEnvoi($messageData['date_envoi']);
                $message->setSenderMiniature($messageData['sender_miniature']);
                $messages[] = $message;
            }
            return $messages;
        }
        return [];
    }

    // Récupère le dernier message d'un chat par son ID
    public function getLastMessageByChatId(int $chat_id): string
    {
        $stmt = $this->db->prepare("
                SELECT message
                FROM {$this->table}
                WHERE chat_id = :chat_id
                ORDER BY date_envoi DESC
                LIMIT 1
                ");
        $stmt->execute(['chat_id' => $chat_id]);
        $last_message = $stmt->fetch();
        if ($last_message === false) {
            return "";
        }
        return $last_message['message'];
    }

    // Envoi d'un nouveau message
    public function newMessage(Message $message): bool
    {
        $data = [
            "chat_id" => $message->getChatId(),
            "sender_id" => $message->getSenderId(),
            "message" => $message->getMessage(),
        ];
        return $this->create($data);
    }
}
