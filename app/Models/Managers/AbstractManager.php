<?php

namespace App\Models\Managers;

use App\Services\DBConnect;
use InvalidArgumentException;

abstract class AbstractManager
{
    protected $db;
    protected ?string $table = null;
    protected ?string $entityClass = null;

    /**
     * Constructeur de la classe AbstractManager.
     * Initialise la connexion à la base de données et définit la table associée.
     */
    public function __construct()
    {
        $this->db = DBConnect::getInstance()->getPDO();
        $this->setTable();
        $this->setEntityClass();
    }

    /**
     * Définit le nom de la table.
     */
    abstract protected function setTable(): void;

    /**
     * Définit la classe d'entité associée.
     */
    abstract protected function setEntityClass(): void;


    /**
     * Méthodes CRUD : find, findAll, delete, create, update
     */

    /**
     * Trouve un enregistrement par son ID.
     * @param int $id : l'identifiant de l'enregistrement.
     * @return object|null : une instance de l'entité ou null si non trouvé.
     */
    public function find(int $id): ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if ($data && $this->entityClass) {
            return new $this->entityClass($data);
        }
        return null;
    }

    /**
     * Trouve tous les enregistrements.
     * @return array : les données de tous les enregistrements sous forme de tableau d'objets.
     */
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $data = $stmt->fetchAll();
        return array_map(fn($item) => new $this->entityClass($item), $data);
    }

    /**
     * Supprime un enregistrement par son ID.
     * @param int $id : l'identifiant de l'enregistrement à supprimer.
     * @return bool : vrai si la suppression a réussi, faux sinon.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Crée un nouvel enregistrement.
     * @param array $data : les données de l'enregistrement.
     * @return bool : vrai si l'enregistrement a été créé avec succès, faux sinon.
     */
    public function create(array $data): bool
    {
        $fields = array_keys($data);
        $placeholders = implode(', ', array_map(fn($field) => ":$field", $fields));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (" . implode(', ', $fields) . ") VALUES ($placeholders)");
        return $stmt->execute($data);
    }

    /**
     * Met à jour un enregistrement existant.
     * @param array $data : les données de l'enregistrement avec l'ID pour la mise à jour.
     * @return bool : vrai si l'enregistrement a été mis à jour avec succès, faux sinon.
     */
    public function update(array $data): bool
    {
        if (!isset($data['id'])) {
            throw new InvalidArgumentException("ID valide nécessaire pour la mise à jour");
        }
        $fields = array_keys($data);
        $setClause = implode(', ', array_map(fn($field) => "$field = :$field", $fields));
        $stmt = $this->db->prepare("UPDATE {$this->table} SET $setClause WHERE id = :id");
        return $stmt->execute($data);
    }
}
