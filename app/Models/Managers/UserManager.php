<?php

namespace App\Models\Managers;

use App\Models\Entities\User;
use App\Models\Managers\AbstractManager;

class UserManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'users'; // Définir le nom de la table pour ce modèle
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = User::class; // Définir le nom de l'entité pour ce modèle
    }
}
