<?php

namespace App\Models\Entities;

use App\Models\Entities\AbstractEntity;

/**
 * Entité Message : un message est défini par son id, un chat associé, un utilisateur, un contenu, et une date d'envoi.
 */
class Message extends AbstractEntity
{
    private int $chat_id;
    private int $user_id;
    private string $message;
    private string $date_envoi;

    /**
     * Setter pour chat_id.
     * @param int $chat_id
     */
    public function setChatId(int $chat_id): void
    {
        $this->chat_id = $chat_id;
    }

    /**
     * Getter pour chat_id.
     * @return int
     */
    public function getChatId(): int
    {
        return $this->chat_id;
    }

    /**
     * Setter pour user_id.
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * Getter pour user_id.
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Setter pour message.
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Getter pour message.
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Setter pour date_envoi.
     * @param string $date_envoi
     */
    public function setDateEnvoi(string $date_envoi): void
    {
        $this->date_envoi = $date_envoi;
    }

    /**
     * Getter pour date_envoi.
     * @return string
     */
    public function getDateEnvoi(): string
    {
        return $this->date_envoi;
    }
}
