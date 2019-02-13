<?php
session_start();
require_once 'bdd.php';

if (!empty($_GET)) {
    $id = $_GET['id'];
    $reponse = $pdo->query("
    SELECT T_RECETTE.IMAGE AS IMAGE, T_RECETTE.TITRE AS TITRE, T_INGREDIENT.NOMINGREDIENT AS NOMINGREDIENT, T_INGREDIENT.QTE_UNITE AS QTE_UNITE 
    FROM T_RECETTE 
    JOIN T_INGREDIENT ON T_RECETTE.ID_RECETTE = T_INGREDIENT.ID_RECETTE");
    $data = $reponse->fetchAll(pdo::FETCH_ASSOC);
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
                    ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $recette["QTE_UNITE"] . ' de ' . $recette['NOMINGREDIENT'] ?></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>


    </div>
</body>
</html>