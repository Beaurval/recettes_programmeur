<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 11/02/2019
 * Time: 14:45
 */

// A l'arriver de cette page on détruit la session puis on redirige l'utilisateur vers la page d'accueil

session_start();
session_destroy();
header('Location: index.php');