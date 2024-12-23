<?php

namespace App\Models\Entities;

use App\Models\Entities\AbstractEntity;

/**
 * Entité Message : un message est défini par son id, un chat associé, un expéditeur, un contenu, et une date d'envoi.
 */
class Message extends AbstractEntity
{
    private int $chat_id;
    private int $sender_id;
    private string $message;
    private string $date_envoi;
    private string $sender_miniature;
    private const DEFAULT_MINIATURE_PROFIL_URL = "miniature-profil-default.png";

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
     * Setter pour sender_id.
     * @param int $sender_id
     */
    public function setSenderId(int $sender_id): void
    {
        $this->sender_id = $sender_id;
    }

    /**
     * Getter pour sender_id.
     * @return int
     */
    public function getSenderId(): int
    {
        return $this->sender_id;
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

    /**
     * Setter pour sender_miniature.
     * @param string $sender_miniature
     */
    public function setSenderMiniature(string $sender_miniature): void
    {
        $this->sender_miniature = $sender_miniature;
    }

    /**
     * Getter pour sender_miniature.
     * @return string
     */
    public function getSenderMiniature(): string
    {
        return $this->sender_miniature ?: self::DEFAULT_MINIATURE_PROFIL_URL;
    }
}
