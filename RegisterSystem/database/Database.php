<?php

namespace projetInscription;

use PDO;

class Database
{
    public readonly PDO $dbConnection;

    public function __construct(string $host, string $dbName, string $dbUser, string $dbPassword) {
        $this->dbConnection = new PDO("mysql:host=$host; dbname=$dbName; charset=utf8", $dbUser, $dbPassword);
    }


//    public function fetchAll(string $query, array $parameters): array
//    {
//        $query = $this->dbConnection->prepare($query);
//        $query->execute($parameters);
//
//        return $query->fetchAll();
//    }


}
