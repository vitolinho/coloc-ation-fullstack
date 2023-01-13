<?php
namespace App\Manager;

use App\Entity\Collocation;
use App\Factory\PDOFactory;
use App\Interfaces\Database;

class CollocationManager extends BaseManager
{
    public function getAllCollocation(): array
    {
        $query = $this->pdo->query("SELECT * from Collocation");

        $Collocation = [];
        while($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $collocation[] = new Collocation($data);
        }
        return $collocation;
    }
    
    public function getCollocationByName(string $name): ?Collocation
    {
        $query = $this->pdo->prepare("SELECT * from Collocation where name = :name");
        $query->bindValue(':name', $name);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$data) return null;

        return new Collocation($data);
    }

    public function getCollocationById(int $id): ?Collocation
    {
        $query = $this->pdo->prepare("SELECT * from Collocation where id = :id");
        $query->bindValue(':id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$data) return null;

        return new Collocation($data);
    }

    public function updateNameById(int $id, string $name) :bool
    {
        $query = $this->pdo->prepare("UPDATE Collocation SET name = :name where id = :id");
        $query->bindValue(':name', $name);
        $query->bindValue(':id', $id);
        return (bool)$query->execute();
    }

    public function insertCollocation(Collocation $collocation) :Collocation
    {
        $query = $this->pdo->prepare("INSERT INTO Collocation (nom, adresse, datetime) VALUES (:nom, :adresse, STR_TO_DATE(:datetime, '%d/%m/%Y %H:%i:%s'));");
        $query->bindValue(':nom', $collocation->getNom());
        $query->bindValue(':adresse', $collocation->getAdresse());
        $query->bindValue(':datetime', $collocation->getDatetime()->format('d/m/Y H:i:s'));
        $query->execute();
        return $collocation;
    }

    public function deleteCollocationById(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM Collocation WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
    }
    
}