<?php
namespace projetInscription;

use projetInscription\Database;

// Comment relier une base de donnée entre les classes.
class EmailVerification extends \projetInscription\Database\Database
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function verifyEmailSyntax($email) : void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: index.php?error=1&message='Email invalide.'");
        }
    }

    public function verifyEmailExist($email) : bool
    {
        $result = $this->db->queryFetch("SELECT COUNT(*) AS emailNumber FROM user WHERE email = ?", [$email]);
        return $result != null;
    }
}