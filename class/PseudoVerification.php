<?php

namespace projetInscription\class;

class PseudoVerification
{
    protected DatabaseManager $db;

    public function __construct(DatabaseManager $db) {
        $this->db = $db;
    }
    public function verifyPseudoIsNotDouble($pseudo) : bool|array
    {
        $result = $this->db->queryFetch("SELECT COUNT(*) AS pseudoNumber FROM user WHERE pseudo = ?", [$pseudo]);
        return $result != null;
    }
}