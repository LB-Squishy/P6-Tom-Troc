<?php

namespace App\Models\Managers;

use App\Models\Entities\Chat;
use App\Models\Managers\AbstractManager;

class ChatManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'chats'; // Définir le nom de la table pour ce modèle
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = Chat::class; // Définir le nom de l'entité pour ce modèle
    }
}
