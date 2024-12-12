<?php

namespace App\Models\Managers;

use App\Models\Entities\Message;
use App\Models\Managers\AbstractManager;

class ChatManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'messages';
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = Message::class;
    }
}
