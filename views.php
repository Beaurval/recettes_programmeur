<?php
/**
 * Created by PhpStorm.
 * User: Enzo
 * Date: 11/02/2019
 * Time: 11:27
 */
session_start();
require_once "bdd.php";
require_once "classes/Recette.php";
if (!empty($_GET)){
    $id=$_GET['id'];
    $reponse = $pdo->query("SELECT * FROM t_recette where ID_RECETTE=$id");
    $test1= $reponse->fetchAll(pdo::FETCH_ASSOC);
    foreach ($test1 as $test){
        $resume=$test['RESUME'];
        $image=$test['IMAGE'];
        $titre=$test['TITRE'];
        $diff=$test['DIFFICULTE'];
        $temps=$test['TEMPS'];
        $cuisson=$test['CUISSON'];
        $date=$test['DATE'];
    }

}


