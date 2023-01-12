<?php
namespace App\Manager;

use App\Entity\Depense;
use App\Factory\PDOFactory;
use App\Interfaces\Database;

class DepenseManager extends BaseManager
{
    public function getAllDepense(): array
    {
        $query = $this->pdo->query("SELECT * from Depense");

        $depense = [];
        while($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $depense[] = new Depense($data);
        }
        return $depense;
    }
    
    public function getDepenseByUserId(int $username): ?Depense
    {
        $query = $this->pdo->prepare("SELECT * from Depense where userId = :userId");
        $query->bindValue(':userId', $userId);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$data) return null;

        return new Depense($data);
    }

    public function getDepenseByMontant(int $montant): ?Depense
    {
        $query = $this->pdo->prepare("SELECT * from Depense where montant = :montant");
        $query->bindValue(':montant', $montant);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$data) return null;

        return new Depense($data);
    }

    public function updateMontantById(int $id, int $montant) :bool
    {
        $query = $this->pdo->prepare("UPDATE Depense SET montant = :montant where id = :id");
        $query->bindValue(':montant', $montant);
        $query->bindValue(':id', $id);
        return (bool)$query->execute();
    }

    public function insertDepense(Depense $depense) :bool
    {
        $query = $this->pdo->prepare("INSERT INTO Depense (montant, description, preuve, userId, collocationId, datetime) VALUES (:montant, :description, :preuve, :userId, :collocationId; STR_TO_DATE(:datetime, '%d/%m/%Y %H:%i:%s'));");
        $query->bindValue(':montant', $depense->getMontant());
        $query->bindValue(':description', $depense->getPreuve());
        $query->bindValue(':preuve', $depense->getDescription());
        $query->bindValue(':userId', $depense->getUserId());
        $query->bindValue(':collocationId', $depense->getCollocationId());
        $query->bindValue(':datetime', $depense->getDatetime()->format('d/m/Y H:i:s'));
        return (bool)$query->execute();
    }

    
    public function updateDepense(Depense $depense) :bool
    {
        $query = $this->pdo->prepare("UPDATE Depense SET montant = :montant, description = :description, preuve = :preuve, userId = :userId, collocationId = :collocationId, datetime = STR_TO_DATE(:datetime, '%d/%m/%Y %H:%i:%s') WHERE id = :id");
        $query->bindValue(':id', $depense->getId());
        $query->bindValue(':montant', $depense->getMontant());
        $query->bindValue(':description', $depense->getPreuve());
        $query->bindValue(':preuve', $depense->getDescription());
        $query->bindValue(':userId', $depense->getUserId());
        $query->bindValue(':collocationId', $depense->getCollocationId());
        $query->bindValue(':datetime', $depense->getDatetime()->format('d/m/Y H:i:s'));
        return (bool)$query->execute();
    }
    public function deleteDepense(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM Depense WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
    }
}