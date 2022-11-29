<?php

namespace projetInscription;

class CryptPassword
{
    public function cryptsha1($password) : string
    {
        if(strlen($password) < 8) {
            header("location: index.php?error=1&message='Votre mot de passe doit faire au moins 8 caractères'");
            exit();
        }

        return "1!/:+".sha1($password)."9*-?";
    }
}