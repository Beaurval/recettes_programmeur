<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 13/02/2019
 * Time: 16:09
 */
require_once 'bdd.php';

//Gestion des bandeau d'erreur
$erreur = '';

if (!empty($_POST))
{
    $login = $_POST['login'];
    $req = $pdo->query("SELECT * FROM T_USER WHERE LOGIN = '$login'"); //Requête qui vérifie si l'utilisateur existe déjà
    $data = $req->fetchAll();

    if ($_POST['mdp1'] == $_POST['mdp2'] && empty($data)) //On vérifie que les mots de passes sont i
    {
        $req = $pdo->prepare("INSERT INTO T_USER(NOM,PRENOM,LOGIN,MDP,DROITS,MAIL) VALUES(?,?,?,?,1,?)");
        $req->execute(
            array(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['login'],
                $_POST['mdp1'],
                $_POST['mail']
            )
        );
    }
    else //Si pas identiques ou utilisateur existant et affichage d'un message en fonction de l'erreur
    {
        if (!empty($data)) //on vérifie si c'est le login qui est déja utilisé
        {
            $erreur = "
                    <div class=\"alert alert-danger mt-2\" role=\"alert\">
                      Login déja utilisé.
                    </div>
                  ";
        }
        //Sinon c'est le mot de passe
        else{
            $erreur = "
                    <div class=\"alert alert-danger mt-2\" role=\"alert\">
                      Les mots de passe ne sont pas identiques.
                    </div>
                  ";
        }

    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'templates/bootstrap.php'; ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/logo.png">
    <title>Connexion</title>
</head>
<body>
<div class="container bg-custom p-3">
    <?php require_once 'templates/navbar.php'; ?>

    <!-- Formulaire d'insription -->
    <form class="mx-auto col-4  m-2 p-3 border" action="inscription.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Nom</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Indiquez votre nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Prenom</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Indiquez votre prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Indiquez votre e-mail" name="mail" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Identifiant</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Choisir votre identifiant" name="login" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1"
                   placeholder="Choisir votre mot de passe" name="mdp1" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirmation</label>
            <input type="password" class="form-control" id="exampleInputPassword1"
                   placeholder="Confirmer" name="mdp2" required>
        </div>
        <button type="submit" class="btn btn-danger btn-block">S'inscrire</button>
        <?= $erreur ?> <!-- Affichage de l'erreur -->
    </form>
</div>
