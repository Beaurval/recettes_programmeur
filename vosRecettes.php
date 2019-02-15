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
     * User: Enzo
     * Date: 11/02/2019
     * Time: 09:31
     */
    session_start();
    $vosRecettes = 'active';
    require_once "bdd.php";
    require_once "classes/Recette.php";
    require_once "templates/bootstrap.php";

    ?>
    <title>Mes recettes</title>
</head>
<body>
    <div class="container bg-custom p-0">
        <?php
        require_once "templates/navbar.php";
        if (!empty($_GET)) {
// Requêtes qui permettent de supprimer les recettes qui appartiennent à l'utilisateur
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
            header('Location: vosRecettes');

        }
        ?>

        <h2>Vos recettes</h2>
        <div class="row col-12 pt-2">
<!-- Requêtes qui affichent les recettes que l'utilisateur à ajouter -->
            <?php
            $id = $_SESSION['id'];
            $reponse = $pdo->query("SELECT * FROM T_RECETTE where ID_user='$id'");
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
                    $obj = new Recette ($test['ID_RECETTE'], $titre, $resume, $diff, $image, 'vosRecettes');
                    echo $obj->toHtml();
                }
            } else {
                ?>
                <div class="bg-custom p-2 col-12">
                    <div class="alert alert-warning" role="alert">
                        <!-- Et si l'utilisateur n'a pas ajouté de recette on l'invite à le faire :) -->
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