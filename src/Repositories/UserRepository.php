<?php

declare(strict_types=1);

namespace Rackforest\Repositories;

use DateTime;
use PDO;
use Rackforest\Models\User;

class UserRepository
{
    private $pdo;

    public function __construct()
    {
        // TODO: This should come from some config
        $this->pdo = new PDO('sqlite:db.sqlite3');
    }

    public function getByUsernamePassword(string $username, string $password): ?User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :username AND is_active = 1 AND deleted_at IS NULL LIMIT 1');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $record = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if (!$record) {
            return null;
        }

        if (!password_verify($password, $record['password']))
        {
            return null;
        }

        return User::fromArray($record);
    }

    /**
     * @return User[] Array of User objects
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users');
        $stmt->execute();
        
        $records = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];

        foreach ($records as $record) {
            $users[] = User::fromArray($record);
        }

        return $users;
    }

    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $record = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if (!$record) {
            return null;
        }

        return User::fromArray($record);
    }

    public function delete(int $id)
    {
        $now = (new DateTime)->format('Y-m-d H:i:s');

        $stmt = $this->pdo->prepare('UPDATE users SET deleted_at = :now WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':now', $now);
        $stmt->execute();
    }
}

