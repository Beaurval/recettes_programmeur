<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 08/02/2019
 * Time: 14:29
 */
try {
    $dn = 'mysql:host=mysql-beaurval.alwaysdata.net:3306;dbname=beaurval_bdd';
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $pdo = new PDO($dn, 'beaurval_distant', 'alwayscesi', $options);

} catch (Exeption $e) {
    die('Erreur :' . $e->getMessage());
}