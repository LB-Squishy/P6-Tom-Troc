<?php

namespace App\Models\Entities;

use App\Models\Entities\AbstractEntity;

/**
 * Entité Book : un book est défini par son id, un user_id(utilisateur associé), un titre, un auteur, une description, une image_url, une disponibilité et une date_ajout.
 */
class Book extends AbstractEntity
{
    private int $user_id;
    private string $userPseudo;
    private string $titre;
    private string $auteur;
    private string $description;
    private string $image_url;
    private bool $disponibilite;
    private string $date_ajout;

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
     * Setter pour le pseudo du propriétaire.
     * @param string $userPseudo;
     */
    public function setUserPseudo(string $pseudo): void
    {
        $this->userPseudo = $pseudo;
    }

    /**
     * Getter pour le pseudo du propriétaire.
     * @param string $userPseudo;
     */
    public function getUserPseudo(): string
    {
        return $this->userPseudo;
    }

    /**
     * Setter pour titre.
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * Getter pour titre.
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Setter pour auteur.
     * @param string $auteur
     */
    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    /**
     * Getter pour auteur.
     * @return string
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * Setter pour description.
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Getter pour description.
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Setter pour image_url.
     * @param string $image_url
     */
    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    /**
     * Getter pour image_url.
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    /**
     * Setter pour disponibilite.
     * @param bool $disponibilite
     */
    public function setDisponibilite(bool $disponibilite): void
    {
        $this->disponibilite = $disponibilite;
    }

    /**
     * Getter pour disponibilite.
     * @return bool
     */
    public function getDisponibilite(): bool
    {
        return $this->disponibilite;
    }

    /**
     * Setter pour date_ajout.
     * @param string $date_ajout
     */
    public function setDateAjout(string $date_ajout): void
    {
        $this->date_ajout = $date_ajout;
    }

    /**
     * Getter pour date_ajout.
     * @return string
     */
    public function getDateAjout(): string
    {
        return $this->date_ajout;
    }
}
