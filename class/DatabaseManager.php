<?php

namespace projetInscription\class;

use PDO;
use PDOStatement;

class DatabaseManager
{
    public PDO $connection;

    //public function __construct(string $host, string $dbName, string $dbUser, string $dbPassword)
    //{
    //    $this->connection = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
    //}


    public function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=projet-inscription;charset=utf8", "root", "");
    }


    public function query($sqlQuery, $param): bool|PDOStatement
    {
        $db = $this->connection->prepare($sqlQuery);
        $db->execute($param);

        return $db;
    }

    public function queryFetch($sqlQuery, $param): array
    {
        $db = $this->connection->prepare($sqlQuery);
        $db->execute([$param]);

        return $db->fetch();
    }
}