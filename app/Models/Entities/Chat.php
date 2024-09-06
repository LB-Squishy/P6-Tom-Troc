<?php

namespace App\Models\Entities;

use App\Models\Entities\AbstractEntity;

/**
 * Entité Chat : un chat est défini par son id, deux utilisateurs associés, et une date de début.
 */
class Chat extends AbstractEntity
{
    private int $user1_id;
    private int $user2_id;
    private string $date_debut;

    /**
     * Setter pour user1_id.
     * @param int $user1_id
     */
    public function setUser1Id(int $user1_id): void
    {
        $this->user1_id = $user1_id;
    }

    /**
     * Getter pour user1_id.
     * @return int
     */
    public function getUser1Id(): int
    {
        return $this->user1_id;
    }

    /**
     * Setter pour user2_id.
     * @param int $user2_id
     */
    public function setUser2Id(int $user2_id): void
    {
        $this->user2_id = $user2_id;
    }

    /**
     * Getter pour user2_id.
     * @return int
     */
    public function getUser2Id(): int
    {
        return $this->user2_id;
    }

    /**
     * Setter pour date_debut.
     * @param string $date_debut
     */
    public function setDateDebut(string $date_debut): void
    {
        $this->date_debut = $date_debut;
    }

    /**
     * Getter pour date_debut.
     * @return string
     */
    public function getDateDebut(): string
    {
        return $this->date_debut;
    }
}
