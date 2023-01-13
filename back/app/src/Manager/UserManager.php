<?php
namespace App\Manager;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Interfaces\Database;

class UserManager extends BaseManager
{
    /**
     * @return User[] array<User>
     */
    public function getAllUser(): array
    {
        $query = $this->pdo->query("SELECT * from User");

        $user = [];
        while($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $user[] = new User($data);
        }
        return $user;
    }
    
    public function getUserByUsername(string $username): ?User
    {
        $query = $this->pdo->prepare("SELECT * from User where username = :username");
        $query->bindValue(':username', $username);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$data) return null;

        return new User($data);
    }

    public function getUserById(int $id): ?User
    {
        $query = $this->pdo->prepare("SELECT * from User where id = :id");
        $query->bindValue(':id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$data) return null;

        return new User($data);
    }

    public function getUserByMail(string $mail): ?User
    {
        $query = $this->pdo->prepare("SELECT * from User where mail = :mail");
        $query->bindValue(':mail', $mail);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$data) return null;

        return new User($data);
    }

    public function updateRoleById(int $id, string $role) :bool
    {
        $query = $this->pdo->prepare("UPDATE User SET role = :role where id = :id");
        $query->bindValue(':role', $role);
        $query->bindValue(':id', $id);
        return (bool)$query->execute();
    }

    public function updateUser(int $id, string $token): int
    {
        $query = $this->pdo->prepare("UPDATE User SET token = :token WHERE id = :id;");
        $query->bindValue(':token', $token);
        $query->bindValue(':id', $id);
        $query->execute();
        return $id;
    }

    /**
     * Ajouter un nouvel utuilisateur
     * 
     * @param User $user
     * @return bool|User
     */
    public function insertUser(User $user) :bool|User
    {
        $query = $this->pdo->prepare("INSERT INTO User (username, mail, password, token, collocationId) VALUES (:username, :mail, :password, :token, :collocationId);");
        $query->bindValue(':username', $user->getUsername());
        $query->bindValue(':mail', $user->getMail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':token', $user->getToken());
        $query->bindValue(':collocationId', $user->getCollocationId());
        $query->execute();
        $user->setId($this->pdo->lastInsertId());
        return $user;
    }

    public function deleteUserById(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM User WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
    }
}
