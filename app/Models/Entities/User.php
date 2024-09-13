<?php

namespace App\Models\Entities;

use App\Models\Entities\AbstractEntity;

/**
 * Entité User : un user est défini par son id, un email, un password, un pseudo et une date_inscription.
 */
class User extends AbstractEntity
{
    private string $email;
    private string $password;
    private string $pseudo;
    private string $date_inscription;

    /**
     * Setter pour email.
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter pour le email.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le date_inscription.
     * @param string $date_inscription
     */
    public function setDateInscription(string $date_inscription): void
    {
        $this->date_inscription = $date_inscription;
    }

    /**
     * Getter pour le date_inscription.
     * @return string
     */
    public function getDateInscription(): string
    {
        return $this->date_inscription;
    }
}
