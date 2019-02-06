<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'templates/bootstrap.php'; ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/logo.png">
    <title>Recettes</title>
</head>
<body>
<div class="container">
    <?php
    require_once 'templates/navbar.php';
    require_once 'classes/Recette.php';
    $recette = new Recette('Croissants', 'Un petit plaisir tous les matins pour toute la famille',
        2, 'assets/recette.jpg');
    $pains = new Recette('Pains au chocolat', 'Pains au chocolat, ou chocolatine, tel est la question.',
        1, 'assets/pains.jpg');
    $raisins = new Recette('Pains aux raisins', 'Personne ne les aimes, mais pourtant irrésistibles',
        4, 'assets/raisins.jpg');
    ?>
    <article class="recettes bg-custom col-12">
        <h2 class="text-custom">Nos recettes</h2>
        <div class="row col-12 ligne">
            <?php
            echo $recette->toHtml();
            echo $recette->toHtml();
            echo $recette->toHtml();
            echo $recette->toHtml();
            echo $recette->toHtml();
            echo $recette->toHtml();
            ?>
        </div>
        <div class="row col-12 ligne ">
            <?php
            echo $pains->toHtml();
            echo $pains->toHtml();
            echo $pains->toHtml();
            echo $pains->toHtml();
            echo $pains->toHtml();
            echo $pains->toHtml();
            ?>
        </div>
        <div class="row col-12 ligne">
            <?php
            echo $raisins->toHtml();
            echo $raisins->toHtml();
            echo $raisins->toHtml();
            echo $raisins->toHtml();
            echo $raisins->toHtml();
            echo $raisins->toHtml();
            ?>
        </div>
        <div class="row col-12 ligne">
            <?php
            echo $recette->toHtml();
            echo $raisins->toHtml();
            echo $pains->toHtml();
            ?>
        </div>
        <div class="row col-12">
            <nav aria-label="..." class="mx-auto">
                <ul class="pagination">
                    <li class="page-item active"><a class="page-link active" onclick="pagination(1)">1</a></li>
                    <li class="page-item"><a class="page-link" onclick="pagination(2)">2</a></li>
                    <li class="page-item"><a class="page-link" onclick="pagination(3)">3</a></li>
                    <li class="page-item"><a class="page-link" onclick="pagination(4)">4</a></li>
                </ul>
            </nav>
        </div>
    </article>

</div>
<script>
    var pages = document.getElementsByClassName('ligne');
    var links = document.getElementsByClassName('page-item');
    hideAll();
    pagination(1);

    function pagination(index) {
        hideAll();
        pages[index - 1].hidden = false;
        activeLink(index);
    }

    function hideAll() {
        for (i = 0; i < pages.length; i++) {
            pages[i].hidden = true;
        }
    }
    function activeLink(index) {
        for (i = 0; i < links.length; i++) {
            links[i].setAttribute('class','page-item');
        }
        links[index-1].setAttribute('class','page-item active');
    }
</script>
</body>
</html>