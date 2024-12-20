<?php

namespace App\Models\Entities;

use App\Models\Entities\AbstractEntity;

/**
 * Entité Chat : un chat est défini par son id, deux utilisateurs associés (un propriétaire et un participant), et une date de création.
 */
class Chat extends AbstractEntity
{
    private int $owner_id;
    private int $participant_id;
    private string $date_creation;
    private string $owner_miniature;
    private string $owner_pseudo;
    private string $participant_miniature;
    private string $participant_pseudo;
    private string $last_message;
    private const DEFAULT_MINIATURE_PROFIL_URL = "miniature-profil-default.png";

    /**
     * Setter pour owner_id.
     * @param int $owner_id
     */
    public function setOwnerId(int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }

    /**
     * Getter pour owner_id.
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    /**
     * Setter pour participant_id.
     * @param int $participant_id
     */
    public function setParticipantId(int $participant_id): void
    {
        $this->participant_id = $participant_id;
    }

    /**
     * Getter pour participant_id.
     * @return int
     */
    public function getParticipantId(): int
    {
        return $this->participant_id;
    }

    /**
     * Setter pour date_creation.
     * @param string $date_creation
     */
    public function setDateCreation(string $date_creation): void
    {
        $this->date_creation = $date_creation;
    }

    /**
     * Getter pour date_creation.
     * @return string
     */
    public function getDateCreation(): string
    {
        return $this->date_creation;
    }

    /**
     * Setter pour owner_miniature.
     * @param string $owner_miniature
     */
    public function setOwnerMiniature(string $owner_miniature): void
    {
        $this->owner_miniature = $owner_miniature;
    }

    /**
     * Getter pour owner_miniature.
     * @return string
     */
    public function getOwnerMiniature(): string
    {
        return $this->owner_miniature ?: self::DEFAULT_MINIATURE_PROFIL_URL;
    }

    /**
     * Setter pour le owner_pseudo.
     * @param string $owner_pseudo
     */
    public function setOwnerPseudo(string $owner_pseudo): void
    {
        $this->owner_pseudo = $owner_pseudo;
    }

    /**
     * Getter pour le owner_pseudo.
     * @return string
     */
    public function getOwnerPseudo(): string
    {
        return $this->owner_pseudo;
    }

    /**
     * Setter pour participant_miniature.
     * @param string $participant_miniature
     */
    public function setParticipantMiniature(string $participant_miniature): void
    {
        $this->participant_miniature = $participant_miniature;
    }

    /**
     * Getter pour participant_miniature.
     * @return string
     */
    public function getParticipantMiniature(): string
    {
        return $this->participant_miniature ?: self::DEFAULT_MINIATURE_PROFIL_URL;
    }

    /**
     * Setter pour le participant_pseudo.
     * @param string $participant_pseudo
     */
    public function setParticipantPseudo(string $participant_pseudo): void
    {
        $this->participant_pseudo = $participant_pseudo;
    }

    /**
     * Getter pour le participant_pseudo.
     * @return string
     */
    public function getParticipantPseudo(): string
    {
        return $this->participant_pseudo;
    }

    /**
     * Setter pour le last_message.
     * @param string $last_message
     */
    public function setLastMessage(string $last_message): void
    {
        $this->last_message = $last_message;
    }

    /**
     * Getter pour le last_message.
     * @return string
     */
    public function getLastMessage(): string
    {
        return $this->last_message;
    }
}
