<?php

namespace projetInscription;

use projetInscription\Database\Database;

class PseudoVerification extends Database
{
    public Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function verifyPseudo($pseudo) : bool
    {
        $result = $this->db->queryFetch("SELECT COUNT(*) AS pseudoNumber FROM user WHERE pseudo = ?", [$pseudo]);
        return $result != null;
    }
}