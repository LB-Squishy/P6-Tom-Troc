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

    // Récupère les x derniers livres
    public function getLastBook(int $nombre_livre)
    {
        $stmt = $this->db->prepare("SELECT b.*, u.pseudo FROM {$this->table} AS b JOIN users AS u ON b.user_id = u.id ORDER BY date_ajout DESC LIMIT :nombre_livre");
        $stmt->bindValue(':nombre_livre', $nombre_livre, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();

        $books = [];
        if ($data && $this->entityClass) {
            foreach ($data as $bookData) {
                $book = new $this->entityClass($bookData);
                $book->setUserPseudo($bookData['pseudo']);
                $books[] = $book;
            }
        }
        return $books;
    }

    // Récupère les livres d'un utilisateur par son id d'utilisateur
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

    // Récupère un livre par son id
    public function getBookById(int $book_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :book_id");
        $stmt->execute(['book_id' => $book_id]);
        $book = $stmt->fetch();

        return $book ? new $this->entityClass($book) : null;
    }

    // Supprime un livre par son id
    public function deleteBookById(int $book_id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :book_id");
        $stmt->execute(['book_id' => $book_id]);
    }

    // Met a jour la disponibilité d'un livre
    public function updateBookDispoById(int $book_id, bool $disponibilite)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET disponibilite = :disponibilite WHERE id = :book_id");
        $stmt->execute([
            'book_id' => $book_id,
            'disponibilite' => $disponibilite
        ]);
    }
}
