<?php

namespace App\Models\Managers;

use App\Models\Managers\AbstractManager;

require_once __DIR__ . '/AbstractManager.php';

class UserManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'users'; // Définir le nom de la table pour ce modèle
    }
}