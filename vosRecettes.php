<link rel="stylesheet" href="css/style.css">
<?php
/**
 * Created by PhpStorm.
 * User: Enzo
 * Date: 11/02/2019
 * Time: 09:31
 */
session_start();
require_once "bdd.php";
require_once "classes/Recette.php";
require_once "templates/bootstrap.php";
require_once "templates/navbar.php";

$id= $_SESSION['id'];
$reponse = $pdo->query("SELECT * FROM t_recette where ID_user='$id'");
$test1= $reponse->fetchAll(pdo::FETCH_ASSOC);
foreach ($test1 as $test){
    $resume=$test['RESUME'];
    $image=$test['IMAGE'];
    $titre=$test['TITRE'];
    $diff=$test['DIFFICULTE'];
    $temps=$test['TEMPS'];
    $cuisson=$test['CUISSON'];
    $date=$test['DATE'];
    $obj = new Recette ($titre,$resume,$diff,$image);
    echo $obj->toHtml();
}



?>

