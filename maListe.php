<?php
session_start();
$maliste = 'active';
require_once 'bdd.php';



    $id = $_SESSION["id"];

    $reponse = $pdo->query("
    SELECT QTE_UNITE, NOMINGREDIENT
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
            require_once 'templates/navbar.php';
        ?>
        <div class="bg-custom"> 
            <div style="text-align:center;">
                <h1>Liste de Courses</h1>
            </div>
            <div>
                <h2 class="txt-none">Les recettes</h2>
                <?php 
                    foreach($data as $recette) 
                {
                    if($recette['QTE_UNITE'] != '')
                        $texte = $recette["QTE_UNITE"] . ' de ' . $recette['NOMINGREDIENT'];
                        else
                        $texte = $recette['NOMINGREDIENT'];

                    ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $texte ?></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>


    </div>
</body>
</html>