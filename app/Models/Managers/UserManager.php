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

    // Inscription d'un nouvel utilisateur
    public function newUser(User $user): bool
    {
        $data = [
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "pseudo" => $user->getPseudo(),
        ];
        return $this->create($data);
    }

    // Récupère un utilisateur par son email
    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch();

        if ($data && $this->entityClass) {
            return new $this->entityClass($data);
        }
        return null;
    }
}
