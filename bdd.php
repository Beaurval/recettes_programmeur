<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 08/02/2019
 * Time: 14:29
 */
try {
    $dn = 'mysql:host=localhost:3308;dbname=recettes';
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $pdo = new PDO($dn, 'root', 'root', $options);

} catch (Exeption $e) {
    die('Erreur :' . $e->getMessage());
}