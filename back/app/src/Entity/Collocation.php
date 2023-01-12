<?php 

namespace App\Entity;
use Datetime;

class Collocation extends BaseEntity implements \JsonSerializable {
    private int $id;
    private string $nom;
    private string $adresse;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
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
            "nom" => getNom(),
            "adresse" => getAdresse(),
            "datetime" => getDateTime()
        ];
    }
}