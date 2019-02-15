<?php
session_start();
$maliste = 'active';
require_once 'bdd.php';


$id = $_SESSION["id"];
// Requête qui va chercher les donnés de QTE_UNITE, NOMINGREDIENT et ID_RECETTE selon l'utilisateur qui est connecté dans la Vue_Ingredients, trié par ordre alphabétique
$reponse = $pdo->query("
    SELECT QTE_UNITE, NOMINGREDIENT,ID_RECETTE
    FROM Vue_Ingredients
    WHERE ID_USER = $id
    ORDER BY NOMINGREDIENT");
$data = $reponse->fetchAll(pdo::FETCH_ASSOC);
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
    <title>Ma Liste de Courses</title>
</head>
<body>
<div class="container p-0">
    <?php
    $maListe = 'active';
    $liste = [];
    require_once 'templates/navbar.php';
    // S'il y a une $data non-vide alors on rentre dans la condition
    if (!empty($data)) {

        ?>
        <div class="bg-custom pl-2">
            <div style="text-align:center;">
                <h1>Liste de Courses</h1>
            </div>
            <div>
                <h2 class="txt-none">Les ingrédients   
                    <!-- Bouton pour exporter en fichier PDF -->         
                    <a class="btn btn-danger" href="convertPdfCourse?id=<?=$_SESSION['id'] ?>">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </h2>
                <ul class="list-group col-6 ml-4">
                    <?php

                    foreach ($data as $recette) {
                        // Boucle qui liste les ingrédients
                        $liste[] = $recette['ID_RECETTE'];
                        if ($recette['QTE_UNITE'] != '')
                        // s'il n'y a pas de QTE_UNITE alors on n'affiche pas " de "
                            $texte = $recette["QTE_UNITE"] . ' de ' . $recette['NOMINGREDIENT'];
                        else
                            $texte = $recette['NOMINGREDIENT'];

                        ?>

                        <li class="list-group-item"><?= $texte ?></li>

                        <?php
                    }
                    ?>
                </ul>
                <?php
                $condition = '';
                foreach (array_unique($liste) as $id) {
                    $condition .= "ID_RECETTE = $id";
                    $condition .= ' OR ';
                }
                $condition = mb_strimwidth($condition, 0, strlen($condition) - 3);

                $req = $pdo->query(
                    "
                            SELECT TITRE,ID_RECETTE 
                            FROM T_RECETTE
                            WHERE $condition

                         "
                );

                ?>
                <h3 class="text-custom">Recettes ajoutées à votre liste</h3>
                <ul class="list-group col-6 ml-4 ">
                    <?php
                    $data = $req->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $titre) {
                        $idRecette = $titre['ID_RECETTE'];
                        $idUser = $_SESSION['id'];
                        // bouton pour supprimer une liste de courses
                        echo "
                        <li class=\"list-group-item \"><a class='align-middle' href='views?id=$idRecette'>" . $titre['TITRE'] . "</a><a href='supprimer?cible=maListe&idRecette=$idRecette&idUser=$idUser' class=\"btn btn-danger float-right\">Supprimer</a></li>
                      ";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="bg-custom p-2 col-12">
            <div class="alert alert-warning" role="alert">
                Vous n'avez pas encore ajouté de recette à votre liste de course.
            </div>
        </div>
        <?php

    }
    ?>


</div>
</body>
</html>