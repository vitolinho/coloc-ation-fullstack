<?php 

namespace App\Entity;
use Datetime;

class Depense extends BaseEntity implements \JsonSerializable{
    private int $id;
    private int $montant;
    private string $description;
    private string $preuve;
    private int $userId;
    private int $collocationId;
    private Datetime | string $dateTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPreuve(): ?string
    {
        return $this->preuve;
    }

    public function setPreuve(string $preuve): self
    {
        $this->preuve = $preuve;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getCollocationId(): ?int
    {
        return $this->collocationId;
    }

    public function setCollocationId(int $CollocationId): self
    {
        $this->CollocationId = $CollocationId;
        return $this;
    }

    public function getDateTime(): Datetime | string

    {
        return $this->datetime;
    }

    public function setDatetime($datetime): self
    {
        $this->datetime = $datetime;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => getId(),
            "montant" => getMontant(),
            "description" => getDescription(),
            "preuve" => getPreuve(),
            "userId" => getUserId(),
            "collocationId" => getCollocationId(),
            "datetime" => getDateTime()
        ];
    }
}