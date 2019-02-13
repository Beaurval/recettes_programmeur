<div class="container">
    <?php
    /**
     * Created by PhpStorm.
     * User: Enzo
     * Date: 11/02/2019
     * Time: 11:27
     */
    session_start();
    require_once "bdd.php";
    require_once 'templates/navbar.php';
    require_once "classes/Recette.php";
    ?>
    <div class="container-fluid bg-custom">
        <?php
        if (!empty($_GET)) {
            $id = $_GET['id'];
            $reponse = $pdo->query("
        SELECT IMAGE,TITRE,RESUME,DIFFICULTE,CUISSON,TEMPS,DATE,NUM,CONSIGNE,NBPERSON
        FROM T_RECETTE
        LEFT JOIN T_ETAPES ON T_RECETTE.ID_RECETTE = T_ETAPES.ID_RECETTE 
        WHERE T_RECETTE.ID_RECETTE=$id
        ORDER BY NUM");
            $data = $reponse->fetchAll(pdo::FETCH_ASSOC);

            $reponse = $pdo->query("
        SELECT IMAGE,TITRE,RESUME,DIFFICULTE,CUISSON,TEMPS,DATE,NBPERSON,QTE_UNITE,INGRENOM
        FROM T_RECETTE
        LEFT JOIN T_INGREDIENT ON T_RECETTE.ID_RECETTE = T_INGREDIENT.ID_RECETTE 
        WHERE t_recette.ID_RECETTE=$id");
            $data2 = $reponse->fetchAll(pdo::FETCH_ASSOC);
        }

        ?>
        <h1 class="titre text-custom"><?= utf8_encode($data[0]['TITRE']) ?></h1>
        <div class="row pt-3 border-top">
            <div class="ml-2">
                <img style="border-radius: 10px" src="<?= $data[0]['IMAGE'] ?>" alt="image_recette" width="420"
                     height="235">
            </div>
            <div class="ml-2 col-6">
                <h2 class="txt-none text-custom2">Description :</h2>
                <p><?= utf8_encode($data[0]['RESUME']) ?></p>
            </div>
        </div>
        <div class="row centerded mt-2" style="font-size: 1.4em">
            <div class="col-2 border-right">
                <span><i class="text-custom2 fas fa-stopwatch"></i> <?= ($data[0]['TEMPS'] + $data[0]['CUISSON']) ?> min</span>
            </div>
            <div class="col-2 border-right">
                <span><strong class="text-custom2"><?= $data[0]['NBPERSON'] ?></strong> personnes</span>
            </div>
            <div class="col-3 progress p-0 ml-3">
                <div class="progress-bar ?> bg-danger" role="progressbar"
                     style="width: <?= ($data[0]['DIFFICULTE'] * 20) ?>%"
                     aria-valuenow="<?= ($data[0]['DIFFICULTE'] * 20) ?>" aria-valuemin="0" aria-valuemax="5">Difficulté
                </div>
            </div>
            <div class="col-4">
                <i class="fas fa-calendar-week text-custom2"></i>
                <span>
                    <?php
                    $format = new IntlDateFormatter('fr-FR',IntlDateFormatter::FULL, IntlDateFormatter::SHORT);
                    echo $format->format(strtotime($data[0]['DATE']));
                    ?>
                </span>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4 col-md-12 border-right">
                <h2>Ingrédients</h2>
                <?php
                foreach ($data2 as $etape)
                {
                ?>
                <div class="row centerded">
                    <p><?= $etape['QTE_UNITE']." de ". $etape['INGRENOM'] ?></p>
                </div>

                <?php
                            }
                            ?>
            </div>
            <div class="col-lg-8 col-md-12">
                <h2>Préparation</h2>
                <div class="col-10 mx-auto">
                    <div class="row bg-secondary text-light rounded-top">
                        <div class="col-12 align-center">
                            <strong><span class="text-center">Temps total : <?= ($data[0]['TEMPS'] + $data[0]['CUISSON']) ?> min</span></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 space-btwn rounded-bot bg-light">
                            <span>Préparation :  <?= $data[0]['TEMPS'] ?> min</span>
                            <span>Cuisson :  <?= $data[0]['CUISSON'] ?> min</span>
                        </div>
                        <div class="col-lg-12 pt-3">
                            <?php
                            foreach ($data as $etape)
                            {
                                ?>
                                <div class="row centerded">
                                    <h5>Etape <?= $etape['NUM'] ?> :</h5>
                                </div>
                                <div class="row">
                                    <p><?= $etape['CONSIGNE'] ?></p>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
