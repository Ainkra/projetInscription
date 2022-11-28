<?php

namespace projetInscription;
use projetInscription\DatabaseConnection;

class EmailVerif extends DatabaseConnection
{
    public
    public readonly string $Email;

    public function __construct(string $email) {
        $this->Email = $email;
    }

    function verifyEmailSyntax(string $email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: index.php?error=1&message='Adresse mail invalide'");
        }
    }

    function verifyEmailIsNotDouble(string $email): void
    {


    }
}