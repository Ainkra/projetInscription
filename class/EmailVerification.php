<?php

namespace projetInscription\class;

use projetInscription\class\DatabaseManager;

class EmailVerification
{
    protected DatabaseManager $db;

    public function __construct(DatabaseManager $db) {
        $this->db = $db;
    }

    public function verifyEmailSyntax($email) : void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: index.php?error=1&message='Syntaxe invalide'");
            exit();
        }
    }

    public function verifyEmailIsNotDouble($email): bool|array
    {
        $result = $this->db->queryFetch("SELECT COUNT(*) AS emailNumber FROM user WHERE email = ?",
            [$email]
        );

        return $result != null;
    }
}