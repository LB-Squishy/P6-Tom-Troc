<?php

namespace App\Models\Managers;

use App\Models\Entities\Book;
use App\Models\Managers\AbstractManager;

class BookManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'books'; // Définir le nom de la table pour ce modèle
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = Book::class; // Définir le nom de l'entité pour ce modèle
    }

    // Récupère les livres d'un utilisateur par son id
    public function getBookByUserId(int $user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetchAll();

        $books = [];
        if ($data && $this->entityClass) {
            foreach ($data as $bookData) {
                $books[] = new $this->entityClass($bookData);
            }
        }
        return $books;
    }

    // Supprime un livre d'un utilisateur par son id
    public function deleteBookByBookId(int $book_id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :book_id");
        $stmt->execute(['book_id' => $book_id]);
    }
}
