<?php

namespace projetInscription;

require_once 'AutoLoader.php';

use Exception;
use projetInscription\class\CryptPassword;
use projetInscription\class\DatabaseManager;
use projetInscription\class\EmailVerification;
use projetInscription\class\PseudoVerification;

try {
    $db = new DatabaseManager();
} catch (Exception $e) {
    die("Erreur: ".$e->getMessage());
}


    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);


        $verifEmail = new EmailVerification($db);
        $verifPseudo = new PseudoVerification($db);
        $passwordCryted = new CryptPassword();


        $verifEmail->verifyEmailSyntax($email);

        if (!$verifEmail->verifyEmailIsNotDouble($email)) {
            header("location: index.php?success=1&message=email disponible");
        }
        else {
            // l'email existe, on arrête.
            header("location: index.php?error=1&message=Email déjà utilisée ! Essayez un autre.");
            exit();
        }

        if (!$verifPseudo->verifyPseudoIsNotDouble($email)) {
            header("location: index.php?success=1&message=Pseudo disponible !");
        }
        else {
            header("location: index.php?success=1&message=Pseudo indisponible");
            exit();
        }

        $password = $passwordCryted -> CryptPassword($password);
        $db->query("INSERT INTO user(pseudo, email, password) VALUE(?,?,?)",
            [$pseudo, $email, $password]);

        header("location: index.php?success=1&message=Le compte a bien été créé. Veuillez vous connecter.");
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/default.css">
        <title>Mon Site PHP</title>
    </head>
    <body>
        <section class="container">

            <form method="post" action="index.php">

                <p>Inscription</p>

                <?php if(isset($_GET['success'])) {
                    echo '<p class="alert success">Inscription réalisée avec succès.</p>';
                }
                else if(isset($_GET['error']) && !empty($_GET['message'])) {
                    echo '<p class="alert error">'.htmlspecialchars($_GET['message']).'</p>';
                } ?>

                <label for="pseudo"></label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"><br>

                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Email"><br>

                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Mot de passe"><br>

                <input type="submit" value="Inscription">

            </form>

            <div class="drop drop-1"></div>
            <div class="drop drop-2"></div>
            <div class="drop drop-3"></div>
            <div class="drop drop-4"></div>
            <div class="drop drop-5"></div>
        </section>
    </body>
</html>