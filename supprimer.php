<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 14/02/2019
 * Time: 13:37
 */
session_start();
require_once 'bdd.php';
if (!empty($_GET))
{
    if ($_GET['cible'] == 'maListe')
    {
        $req = $pdo->prepare("DELETE FROM T_COURSE WHERE ID_RECETTE = :id AND ID_USER = :idUser");
        $req->execute(
            array(
                ':id' => $_GET['idRecette'],
                ':idUser' => $_SESSION['id']
            )
        );
        header('Location: maListe.php');
    }
}
else
{
    header('Location: index.php');
}