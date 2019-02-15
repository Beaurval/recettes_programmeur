<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    /**
     * Created by PhpStorm.
     * User: Valentin Beaury
     * Date: 13/02/2019
     * Time: 16:01
     */
    session_start();
    $admin = 'active';
    require_once "bdd.php";
    require_once "classes/Recette.php";
    require_once "templates/bootstrap.php";
    ?>
    <title>Espace admin</title>
</head>
<body>
<div class="container bg-custom p-0">
    <?php
    require_once "templates/navbar.php";

    //Gestion des requêtes pour supprimer la recette demandée
    if (!empty($_GET)) {

        $req = $pdo->prepare("DELETE FROM T_COURSE WHERE ID_RECETTE = :id");
        $req->execute(
            array(
                ':id' => $_GET['id'],
            )
        );

        $req = $pdo->prepare("DELETE FROM T_INGREDIENT WHERE ID_RECETTE = :id");
        $req->execute(
            array(
                ':id' => $_GET['id'],
            )
        );

        $req = $pdo->prepare("DELETE FROM T_ETAPES WHERE ID_RECETTE = :id");
        $req->execute(
            array(
                ':id' => $_GET['id'],
            )
        );


        $req = $pdo->prepare("DELETE FROM T_RECETTE WHERE ID_RECETTE = :id");
        $req->execute(
            array(
                ':id' => $_GET['id'],
            )
        );
        header('Location: vosRecettes.php');

    }
    ?>

    <h2>Les recettes du site</h2>
    <div class="row col-12 pt-2">

        <?php
        $id = $_SESSION['id'];
        $reponse = $pdo->query("SELECT * FROM T_RECETTE");
        $test1 = $reponse->fetchAll(pdo::FETCH_ASSOC);
        if (!empty($test1)) {
            foreach ($test1 as $test) {
                $resume = $test['RESUME'];
                $image = $test['IMAGE'];
                $titre = $test['TITRE'];
                $diff = $test['DIFFICULTE'];
                $temps = $test['TEMPS'];
                $cuisson = $test['CUISSON'];
                $date = $test['DATE'];
                $obj = new Recette ($test['ID_RECETTE'], $titre, $resume, 0, $image, 'vosRecettes.php');
                echo $obj->toHtml();
            }
        } else {
            ?>
            <div class="bg-custom p-2 col-12">
                <div class="alert alert-warning" role="alert">
                    Vous n'avez pas de recettes, vous pouvez en ajouter une dans l'onglet : "Ajouter une recette" !
                </div>
            </div>
            <?php

        }
        ?>
    </div>
</div>
</body>
</html>