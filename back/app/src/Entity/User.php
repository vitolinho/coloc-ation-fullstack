<?php 

namespace App\Entity;

class User extends BaseEntity implements \JsonSerializable{

    private ?int $id = null;
    private ?string $username = null;
    private ?string $mail = null;
    private ?string $password = null;
    private ?string $role = null;
    private ?string $token = null;
    private ?int $collocationId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): ?User
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getMail(): ?string 
    {
        return $this-> mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password, bool $hash = false)
    {
        if ($hash) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        $this->password = $password;
        return $this;
    }

    public function verifyPassword($plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }

    public function getRole(): ?string
    {
        return $this->$role;
    }
    
    public function setRole(?string $role): self
    {
        $this ->role = $role;
        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function getCollocationId(): ?int
    {
        return $this->collocationId;
    }
    
    public function setCollocationId(?int $collocationId): self
    {
        $this->collocationId = $collocationId;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => getId(),
            "username" => getUsername(),
            "mail" => getMail(),
            "password" => getPassword(),
            "role" => getRole(),
            "token" => getToken(),
            "collocationId" => getCollocationId()
        ];
    }
}

