<?php
session_start();
$maliste = 'active';
require_once 'bdd.php';
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
                           
            </div>
        </div>


    </div>
</body>
</html>