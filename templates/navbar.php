<?php
if (isset($_SESSION['succes']))
    $isConned = '';
else
    $isConned = 'hidden';

?>

<nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom">
    <div class="titre ">
        <a class="navbar-brand" href="index.php">
            <img src="assets/logo.png" width="100" height="80" class="d-inline-block align-top" alt="logo">
        </a>
        <label class="text-custom" >Les recettes pour tous !</label>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="mx-auto col-xl-9 col-sm-4">
        <form class="form-inline">
            <input class="form-control rounded-pill col-12" type="search" placeholder="Chercher une recette" aria-label="Search">
        </form>
    </div>

    <?php
    if (!isset($_SESSION['succes'])) {
        ?>
        <div class="login titre">
            <a id='login' href="connexion.php" class="btn btn-orange text-light rounded-pill">
                <i class="fas fa-user"></i>
            </a>
            <label class="text-custom" for="login">Connexion</label>
        </div>
        <?php
    }
    ?>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item" >
                <a class="nav-link " href="index.php">Nos recettes<span class="sr-only">(current)</span></a>
            </li>
            <?php if(isset($_SESSION['succes'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link " href="ajouter.php">Ajouter une recette</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Vos recettes</a>
                </li>
                <?php
            }
            ?>
        </ul>

    </div>
</nav>