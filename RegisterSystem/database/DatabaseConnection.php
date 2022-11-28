<?php

namespace projetInscription;
require 'Database.php';

class DatabaseConnection extends Database
{
    public function dbConnect()
    {
        $db = new Database("localhost", "project-inscription", "root", "");
    }

    public function request(string $query, array $parameters): array
    {
        $query = $this->dbConnection->prepare($query);
        $query->execute($parameters);

        return $query->fetch();
    }
}