<?php
require_once 'templates/bootstrap.php';
if (isset($_SESSION['succes']))
    $isConned = '';
else
    $isConned = 'hidden';

if (!isset($vosRecettes))
    $vosRecettes = '';
if (!isset($nosRecettes))
    $nosRecettes = '';
if (!isset($ajouter))
    $ajouter = '';
if (!isset($maListe))
    $maListe = '';
if (!isset($maListe))
    $maListe = '';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom">
    <div class="titre ">
        <a class="navbar-brand" href="index.php">
            <img src="assets/logo.png" width="100" height="80" class="d-inline-block align-top" alt="logo">
        </a>
        <label class="text-custom">Les recettes pour tous</label>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="mx-auto col-xl-9 col-sm-4">
        <form class="form-inline">
            <input class="form-control rounded-pill col-12" type="search" placeholder="Chercher une recette"
                   aria-label="Search">
        </form>
    </div>

    <div class="login titre">
        <?php
        if (!isset($_SESSION['succes'])) {
            ?>
            <a id='login' href="connexion.php" class="btn btn-success text-light rounded-pill">
                <i class="fas fa-user"></i>
            </a>
            <label class="text-custom" for="login">Connexion</label>
            <?php
        } else {
            ?>
            <a href="logout.php" class="btn btn-danger text-light rounded-pill">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <label class="text-custom" for="login">Déconnexion</label>
            <?php
        }
        ?>

    </div>

</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= $nosRecettes?>">
                <a class="nav-link " href="index.php">Nos recettes<span class="sr-only">(current)</span></a>
            </li>
            <?php if (isset($_SESSION['succes'])) {
                ?>
                <li class="nav-item <?= $ajouter?>">
                    <a class="nav-link " href="ajouter.php">Ajouter une recette</a>
                </li>
                <li class="nav-item <?= $vosRecettes?>">
                    <a class="nav-link " href="vosRecettes.php">Vos recettes</a>
                </li>
                <li class="nav-item <?= $maListe?>">
                    <a class="nav-link " href="maListe.php">Ma Liste de Courses</a>
                </li>
                <?php
            }
            ?>
        </ul>

    </div>
</nav>