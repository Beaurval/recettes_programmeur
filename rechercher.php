<?php
/**
 * Created by PhpStorm.
 * User: Enzo
 * Date: 14/02/2019
 * Time: 15:34
 */
session_start();
$vosRecettes = 'active';
require_once "bdd.php";
require_once "classes/Recette.php";
require_once "templates/bootstrap.php";
?>


<div class="container bg-custom">
    <h2>Votre recherche</h2>
    <?php
    require_once "templates/navbar.php";
    // recuperer la recherche via l'URL
    $rech=$_GET['rechercher'];
    // selectionner toutes les recettes dont le titre comporte un des mots de la recherche
    $req = $pdo->query('SELECT * FROM T_RECETTE WHERE TITRE LIKE "%'.$rech.'%" order by TITRE');
    $test1 = $req->fetchAll(pdo::FETCH_ASSOC);
    // mettre toutes les données dans l'objet Recette
    foreach ($test1 as $test) {
        $resume = $test['RESUME'];
        $image = $test['IMAGE'];
        $titre = $test['TITRE'];
        $diff = $test['DIFFICULTE'];
        $temps = $test['TEMPS'];
        $cuisson = $test['CUISSON'];
        $date = $test['DATE'];
        $obj = new Recette ($test['ID_RECETTE'],$titre, $resume, $diff, $image);
        echo $obj->toHtml();
    }


    ?>
</div>
