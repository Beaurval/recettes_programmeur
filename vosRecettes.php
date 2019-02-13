<div class="container bg-custom p-0">
    <?php
    /**
     * Created by PhpStorm.
     * User: Enzo
     * Date: 11/02/2019
     * Time: 09:31
     */
    session_start();
    $vosRecettes = 'active';
    require_once "bdd.php";
    require_once "classes/Recette.php";
    require_once "templates/bootstrap.php";
    require_once "templates/navbar.php";
    ?>
    <h2>Vos recettes</h2>
    <div class="row col-12 pt-2">

        <?php
        $id = $_SESSION['id'];
        $reponse = $pdo->query("SELECT * FROM T_RECETTE where ID_user='$id'");
        $test1 = $reponse->fetchAll(pdo::FETCH_ASSOC);
        foreach ($test1 as $test) {
            $resume = $test['RESUME'];
            $image = $test['IMAGE'];
            $titre = $test['TITRE'];
            $diff = $test['DIFFICULTE'];
            $temps = $test['TEMPS'];
            $cuisson = $test['CUISSON'];
            $date = $test['DATE'];
            $obj = new Recette ($test['ID_RECETTE'],utf8_encode($titre), utf8_encode($resume), $diff, $image);
            echo $obj->toHtml();
        }


        ?>
    </div>
</div>