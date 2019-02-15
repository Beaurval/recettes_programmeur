<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 14/02/2019
 * Time: 13:37
 */
session_start();
require_once 'bdd.php';
// si le GET n'est pas vide
if (!empty($_GET))
{
    //et si le GET cible vaut maListe
    if ($_GET['cible'] == 'maListe')
    {
        // preparer et exectuter une suppression dans T_course où l'ID_RECETTE vaut id et ID_USER vaut idUser (recupérés via l'URL)
        $req = $pdo->prepare("DELETE FROM T_COURSE WHERE ID_RECETTE = :id AND ID_USER = :idUser");
        $req->execute(
            array(
                ':id' => $_GET['idRecette'],
                ':idUser' => $_SESSION['id']
            )
        );
        //retour a la liste de course
        header('Location: maListe.php');
    }
}
else
{
    // retour à la page d'acceuil
    header('Location: index.php');
}