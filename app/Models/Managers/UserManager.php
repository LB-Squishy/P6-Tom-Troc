<?php

namespace App\Models\Managers;

use App\Models\Entities\User;
use App\Models\Managers\AbstractManager;

class UserManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'users';
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = User::class;
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

    // Met à jour les infos d'un utilisateur
    public function updateUser(User $user): bool
    {
        $data = [
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "pseudo" => $user->getPseudo(),
        ];
        return $this->update($data);
    }

    // Met à jour la photo d'un utilisateur
    public function updateProfilePhoto(User $user): bool
    {
        $data = [
            "id" => $user->getId(),
            "miniature_profil_url" => $user->getMiniatureProfilUrl(),
        ];
        return $this->update($data);
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

    // Récupère un utilisateur par son pseudo
    public function getUserByPseudo(string $pseudo): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE pseudo = :pseudo");
        $stmt->execute(['pseudo' => $pseudo]);
        $data = $stmt->fetch();

        if ($data && $this->entityClass) {
            return new $this->entityClass($data);
        }
        return null;
    }
}
