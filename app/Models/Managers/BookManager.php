<?php

namespace App\Models\Managers;

use App\Models\Entities\Book;
use App\Models\Managers\AbstractManager;

class BookManager extends AbstractManager
{
    protected function setTable(): void
    {
        $this->table = 'books';
    }
    protected function setEntityClass(): void
    {
        $this->entityClass = Book::class;
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

    // Récupère les x derniers livres par titre
    public function getBookByTitle(int $nombre_livre, string $titre)
    {
        $stmt = $this->db->prepare("SELECT b.*, u.pseudo FROM {$this->table} AS b JOIN users AS u ON b.user_id = u.id WHERE b.titre LIKE :titre ORDER BY date_ajout DESC LIMIT :nombre_livre
        ");
        $stmt->bindValue(':titre', '%' . $titre . '%', \PDO::PARAM_STR);
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

    // Récupère un livre par son id avec le pseudo et la photo du propriétaire
    public function getBookById(int $book_id)
    {
        $stmt = $this->db->prepare("SELECT b.*, u.pseudo, u.miniature_profil_url FROM {$this->table} AS b JOIN users AS u ON b.user_id = u.id WHERE b.id = :book_id");
        $stmt->bindValue(':book_id', $book_id, \PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetch();

        if ($book && $this->entityClass) {
            $bookData = new $this->entityClass($book);
            $bookData->setUserPseudo($book['pseudo']);
            $bookData->setMiniatureProfilUrl($book['miniature_profil_url']);
        }
        return $bookData;
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

    // Met à jour les infos d'un livre
    public function updateBookById(int $book_id, Book $book): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET titre = :titre, auteur = :auteur, description = :description, disponibilite = :disponibilite WHERE id = :book_id");
        $stmt->execute([
            'titre' => $book->getTitre(),
            'auteur' => $book->getAuteur(),
            'description' => $book->getDescription(),
            'disponibilite' => (int) $book->getDisponibilite(),
            'book_id' => $book_id
        ]);
        return $stmt->rowCount() > 0;
    }

    // Met à jour la couverture d'un livre
    public function updateBookCover(Book $book): bool
    {
        $data = [
            "id" => $book->getId(),
            "image_url" => $book->getImageUrl(),
        ];
        return $this->update($data);
    }
}
