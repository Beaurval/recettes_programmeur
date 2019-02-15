<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'templates/bootstrap.php'; ?>
    <link rel="icon" href="assets/logo.png">
    <title>Recettes</title>
</head>
<body>
<div class="container">
    <?php
    session_start(); //Démarrage de la session
    $nosRecettes = 'active'; //Variable pour gérer les liens actif de la barre de navigation
    require_once 'templates/navbar.php';
    require_once 'classes/Recette.php'; //Objet pour afficher une carte recette
    require_once 'bdd.php';
    $rep = $pdo->query("SELECT * FROM T_RECETTE ORDER BY DATE"); //Requete pour récupérer toutes les recettes
    $datas = $rep->fetchAll(PDO::FETCH_ASSOC); //On souhaite avoir des tableaux associatifs
    ?>

    <!--Conteneur bootstrap-->
    <article class="bg-custom col-12">
        <h2 class="text-custom">Nos recettes</h2>
        <?php
        //Compteurs
        $nb = 0;
        $nbObjets = 0;

        //Pour chaque recette on insère les valeurs dans un objet afin de les afficher dans des cards bootstrap
        foreach ($datas as $data) {
            if ($nb == 0) //Compteur qui gère les div row afin de mettre 6 recettes par div
                echo "<div class=\"row col-12 ligne\">";

            $obj = new Recette($data['ID_RECETTE'], $data['TITRE'], $data['RESUME'], $data['DIFFICULTE'], $data['IMAGE']); //Insertion des valeurs dans l'objet
            echo $obj->toHtml(); //affichage de l'objet dans une card bootstrap

            //incrémentation des compteurs
            $nb++;
            $nbObjets++;

            if ($nb == 6 || $nbObjets == count($datas)) //après 6 recettes on ferme la balise et on réinitialise le compteur
            {
                echo "</div>";
                $nb = 0;
            }

        }
        ?>
      <!-- Boutons de pagination-->
        <div class="row col-12">
            <nav aria-label="..." class="mx-auto">
                <ul class="pagination">
                    <li class="page-item active"><a class="page-link active" onclick="pagination(1)">1</a></li>
                    <?php

                    //On compte le nombre de recettes total afin de compter le nombre de page que l'on va afficher (6 recettes par page)
                    for ($i = 2; $i <= ceil($nbObjets / 6); $i++) {
                        echo "<li class=\"page-item\"><a class=\"page-link\" onclick=\"pagination($i)\">$i</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </article>

</div>
<script src="js/pagination.js"></script>
</body>
</html>