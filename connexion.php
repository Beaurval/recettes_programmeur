<?php
session_start();
require_once 'bdd.php';



if (!empty($_POST))
{
    //Récupération des infos
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    //requête pour voir si l'utilisateur existe
    $rep = $pdo->query("SELECT * FROM T_USER WHERE LOGIN = '$login'");
    $data = $rep->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($data))
    {
        if ($data[0]['MDP'] === $mdp && $data[0]['LOGIN'] === $login) //si le mot de passe est bon
        {
            $_SESSION['succes'] = true; //On connecte l'utilisateur
            $_SESSION['id'] = $data[0]['ID_USER']; //et on récupère son id

            if ($data[0]['DROITS'] == 10) //Si il est admin on le retient
            {
                $_SESSION['admin'] = true;
            }

            header('Location: index'); //redirection
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

    <!-- Formulaire de connexion -->
    <form class="mx-auto col-4  m-2 p-3 border" action="connexion.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Identifiant</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Entrez votre identifiant" name="login" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1"
                   placeholder="Entrez votre mot de passe" name="mdp" required>
        </div>
        <a href="inscription.php">S'inscrire</a>
        <button type="submit" class="btn btn-danger btn-block">Envoyer</button>
    </form>
</div>
