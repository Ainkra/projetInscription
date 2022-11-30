<?php

namespace projetInscription\class;

class CryptPassword
{
    public function CryptPassword($password): string
    {
        return "?;:15!".sha1($password)."!/?+-zd";
    }
}