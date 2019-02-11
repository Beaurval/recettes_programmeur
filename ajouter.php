<?php
session_start();
require_once 'bdd.php';
var_dump($_SESSION['ID_USER']);


if (!empty($_POST)) {
    $titre = $_POST['TITRE'];
    $resume = $_POST['RESUME'];
    $image = $_POST['IMAGE'];
    $difficulte = $_POST['DIFFICULTE'];
    $temps = $_POST['TEMPS'];
    $cuisson = $_POST['CUISSON'];
    $req = $pdo->prepare('INSERT INTO t_recette(ID_USER, TITRE, RESUME, IMAGE, DIFFICULTE, TEMPS, CUISSON, DATE) VALUES(?,?,?,?,?,?,?,NOW())');
    $req->execute(array(
        $_SESSION['ID_USER'],
        $_POST['TITRE'],
        $_POST['RESUME'],
        $_POST['IMAGE'],
        $_POST['DIFFICULTE'],
        $_POST['TEMPS'],
        $_POST['CUISSON']
    ));

    $numero = 1;
    foreach($_POST['CONSIGNE'] as $consigne) {

        $req = $pdo->prepare('INSERT INTO t_etapes(ID_RECETTE, NUM, CONSIGNE) VALUES(?,?,?)');
        $req->execute(array(
            $pdo->lastInsertId(),
            $numero,
            $consigne
        ));
        $numero ++;
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
<div class="container">

    <?php
    $ajouter = 'active';
    require_once 'templates/navbar.php';
    ?>
    <form action="ajouter.php" method="POST" class="bg-custom p-5">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" aria-describedby="emailHelp" name="TITRE" placeholder="">
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
                <input type="text" class="form-control" id="step" name="CONSIGNE[]">
                <button class="add_field_button"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="IMAGE">
        </div>
        <hr>
        <p>Difficulté</p>
        <div id="reviewStars-input">
            <input id="star-4" type="radio" value="5" name="DIFFICULTE"/>
            <label title="gorgeous" for="star-4"></label>

            <input id="star-3" type="radio" value="4" name="DIFFICULTE"/>
            <label title="good" for="star-3"></label>

            <input id="star-2" type="radio" value="3" name="DIFFICULTE"/>
            <label title="regular" for="star-2"></label>

            <input id="star-1" type="radio" value="2" name="DIFFICULTE"/>
            <label title="poor" for="star-1"></label>

            <input id="star-0" type="radio" value="1" name="DIFFICULTE"/>
            <label title="bad" for="star-0"></label>
        </div>
        <div class="input-group">
            <label for="temps">Temps de préparation</label>
            <input type="text" id="temps" name="TEMPS" class="form-control">
            <div class="input-group-append">
                <span class="input-group-text">min</span>
            </div>
        </div>
        <hr>
        <div class="input-group">
            <label for="cuisson">Temps de cuisson</label>
            <input type="text" id="cuisson" name="CUISSON" class="form-control">
            <div class="input-group-append">
                <span class="input-group-text">min</span>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count


        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed

                //text box increment
                $(wrapper).append('<div><input class="form-control" type="text" name="CONSIGNE[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                x++;
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text

            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

</script>
