<?php

namespace App\Factory;

use App\Interfaces\Database;

class PDOFactory implements Database
{
    private string $host;
    private string $dbName;
    private string $userName;
    private string $password;

    public function __construct(string $host = "db", string $dbName = "colocdb", string $userName = "root", string $password = "password")
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->userName = $userName;
        $this->password = $password;
    }

    public function getMySqlPDO(): \PDO
    {
        return new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
    }

}
