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
require_once "templates/navbar.php";


?>
<h2>Votre recherche</h2>
<div class="row col-12 pt-2">

    <?php
    $rech=$_GET['rechercher'];
    $req = $pdo->query('SELECT * FROM T_RECETTE WHERE TITRE LIKE "%'.$rech.'%" order by TITRE');
    $test1 = $req->fetchAll(pdo::FETCH_ASSOC);
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
</div>
