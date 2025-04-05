<?php

declare(strict_types=1);

namespace Rackforest\Repositories;

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
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :username LIMIT 1');
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
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
}

