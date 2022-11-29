<?php

use projetInscription\Database\Database;
use projetInscription\EmailVerification;
use projetInscription\PseudoVerification;
use projetInscription\CryptPassword;


if(!empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['pseudo'])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $pseudo = htmlspecialchars($_POST["pseudo"]);

    $db = new Database("localhost", "projet-inscription", "root", "");
    $emailVerification = new EmailVerification($db);
    $pseudoVerification = new PseudoVerification($db);
    $passwordCrypt = new CryptPassword();

    if (!$emailVerification->verifyEmailExist($email)){
        // L'email n'existe pas, on continue
        header("location: index.php?success=1&message='email disponible'");
    }
    else {
        // l'email existe, on arrête.
        header('location: index.php?error=1&message=Email déjà utilisée ! Essayez un autre.');
        exit();
    }

    if($pseudoVerification->verifyPseudo($pseudo)) {
        header("location: index.php?success=1&message='Pseudo valide'");
    } else {
        header("location: index.php?error=1&message='Pseudo déjà utilisé. Essayez un autre'");
        exit();
    }

    $passwordCrypt->cryptsha1($password);




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

                <p>Incription</p>

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