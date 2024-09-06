<?php

namespace App\Models\Managers;

use App\Models\Entities\Message;
use App\Models\Managers\AbstractManager;

class ChatManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'messages'; // Définir le nom de la table pour ce modèle
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = Message::class; // Définir le nom de l'entité pour ce modèle
    }
}
