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
    session_start();
    require_once 'templates/navbar.php';
    require_once 'classes/Recette.php';
    require_once 'bdd.php';
    $rep = $pdo->query("SELECT * FROM t_recette ORDER BY DATE");
    $datas = $rep->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <article class="recettes bg-custom col-12">
        <h2 class="text-custom">Nos recettes</h2>
        <?php
        $nb=0;
        $nbObjets = 0;
        foreach ($datas as $data) {
            if ($nb ==0)
                echo "<div class=\"row col-12 ligne\">";

            $obj = new Recette($data['TITRE'], utf8_encode($data['RESUME']).' '.$nb, $data['DIFFICULTE'], $data['IMAGE']);
            echo $obj->toHtml();

            $nb++;
            $nbObjets++;
            if ($nb == 6 || $nbObjets == count($datas))
            {
                echo "</div>";
                $nb = 0;
            }

        }
        ?>
        <div class="row col-12">
            <nav aria-label="..." class="mx-auto">
                <ul class="pagination">
                    <li class="page-item active"><a class="page-link active" onclick="pagination(1)">1</a></li>
                    <?php
                    for ($i=2; $i<=round($nbObjets/6); $i++)
                    {
                        echo "<li class=\"page-item\"><a class=\"page-link\" onclick=\"pagination($i)\">$i</a></li>";
                    }
                    ?>
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
            links[i].setAttribute('class', 'page-item');
        }
        links[index - 1].setAttribute('class', 'page-item active');
    }
</script>
</body>
</html>