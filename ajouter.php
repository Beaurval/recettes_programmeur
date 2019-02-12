<?php
session_start();
require_once 'bdd.php';


if (!empty($_POST)) {
    $titre = $_POST['TITRE'];
    $resume = $_POST['RESUME'];
    $image = $_POST['IMAGE'];
    $difficulte = $_POST['DIFFICULTE'];
    $temps = $_POST['TEMPS'];
    $cuisson = $_POST['CUISSON'];
    $req = $pdo->prepare('INSERT INTO t_recette(ID_USER, TITRE, RESUME, IMAGE, DIFFICULTE, TEMPS, CUISSON, DATE) VALUES(?,?,?,?,?,?,?,NOW())');
    $req->execute(array(
        $_SESSION['id'],
        $_POST['TITRE'],
        $_POST['RESUME'],
        $_POST['IMAGE'],
        $_POST['DIFFICULTE'],
        $_POST['TEMPS'],
        $_POST['CUISSON']
    ));

    $lastId = $pdo->lastInsertId();
    $numero = 1;
    foreach ($_POST['CONSIGNE'] as $consigne) {

        $req = $pdo->prepare('INSERT INTO t_etapes(ID_RECETTE, NUM, CONSIGNE) VALUES(?,?,?)');
        $req->execute(array(
            $lastId,
            $numero,
            $consigne
        ));
        $numero++;
    }
}


?>
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
<div class="container p-0">

    <?php
    $ajouter = 'active';
    require_once 'templates/navbar.php';
    ?>
    <div class="row col-12 bg-custom m-0">
        <form action="ajouter.php" method="POST" class="col-8 mx-auto">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" aria-describedby="emailHelp" name="TITRE"
                       placeholder="">
            </div>
            <hr>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="RESUME" rows="3"></textarea>
            </div>
            <hr>
            <div class="input_fields_wrap form-group">
                <div>
                    <label for="step">Étapes</label>
                    <button class="add_field_button btn btn-success"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <hr>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="IMAGE">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Sélectionnez
                        un fichier</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="inputGroupFileAddon02">Image</span>
                </div>
            </div>
            <hr>
            <div class="input-group">
                <input type="number" id="temps" name="TEMPS" class="form-control col-3"
                       placeholder="Préparation">
                <div class="input-group-append">
                    <span class="input-group-text">min</span>
                </div>
            </div>
            <hr>
            <div class="input-group">
                <input type="number" id="cuisson" name="CUISSON" class="form-control col-3"
                       placeholder="Cuisson">
                <div class="input-group-append">
                    <span class="input-group-text">min</span>
                </div>
            </div>
            <hr>
            <p class="m-0">Difficulté</p>
            <div class="rating">
                <label>
                    <input type="radio" name="DIFFICULTE" value="1"/>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="DIFFICULTE" value="2"/>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="DIFFICULTE" value="3"/>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="DIFFICULTE" value="4"/>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="DIFFICULTE" value="5"/>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
            </div>

            <button type="submit" class="btn btn-danger col-6 m-auto">Submit</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count


        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed

                //text box increment
                $(wrapper).append('<div><input class="form-control" type="text" name="CONSIGNE[]"/><a href="#"  class="remove_field">Supprimer</a></div>'); //add input box
                x++;
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text

            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

</script>
