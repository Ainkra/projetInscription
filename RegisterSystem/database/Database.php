<?php

namespace projetInscription\Database;

class Database
{
    public readonly PDO $database;

    public function __construct(string $host, string $dbname, string $dbUser, string $dbPassword)
    {
        $this->database = new PDO("mysql:host=$dbPassword; dbname=$dbname; charset=utf8;", $dbUser, $dbPassword);
    }

    public function queryFetch(string $sqlQuery, array $param) : array|null
    {
        $db = $this->database->prepare($sqlQuery);
        $db -> execute($param);

        return $db->fetch();
    }

    public function queryFetchAll(string $sqlQuery, array $param) : array
    {
        $db = $this->database->prepare($sqlQuery);
        $db -> execute($param);

        return $db->fetchAll();
    }
}