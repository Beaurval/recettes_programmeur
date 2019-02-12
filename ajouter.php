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

    $req = $pdo->prepare('INSERT INTO t_recette(ID_USER, TITRE, RESUME, IMAGE, DIFFICULTE, TEMPS, CUISSON, DATE,NBPERSON) VALUES(?,?,?,?,?,?,?,NOW(),?)');
    $req->execute(array(
        $_SESSION['id'],
        utf8_decode($_POST['TITRE']),
        utf8_decode($_POST['RESUME']),
        utf8_decode($_POST['IMAGE']),
        $_POST['DIFFICULTE'],
        $_POST['TEMPS'],
        $_POST['CUISSON'],
        $_POST['personne']
    ));


    //On récupère la dernière ID insérée dans la Base (ici c'est ID_RECETTE)
    $lastId = $pdo->lastInsertId();

    //numéro de l'étape (c'est un compteur qui s'incrémente
    $numero = 1;

    //$_POST['CONSIGNE'] est un tableau qui contient nos étapes, donc pour chaque index du tableau on insert dans $consigne
    foreach ($_POST['CONSIGNE'] as $consigne) {
        //On insert dans la base chaque consigne recue, mais pour la même recette
        $req = $pdo->prepare('INSERT INTO t_etapes(ID_RECETTE, NUM, CONSIGNE) VALUES(?,?,?)');

        //on indique la valeur dans l'ordre de chaque '?'
        $req->execute(array(
            $lastId,
            $numero,
            $consigne
        ));

        //On incrémente notre compteur d'étapes
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
                <input required type="text" class="form-control" id="titre" aria-describedby="emailHelp" name="TITRE"
                       placeholder="">
            </div>
            <hr>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea required class="form-control" id="description" name="RESUME" rows="3"></textarea>
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
                    <input required type="file" class="custom-file-input" id="inputGroupFile02" name="IMAGE">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Sélectionnez
                        un fichier</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="inputGroupFileAddon02">Image</span>
                </div>
            </div>
            <hr>
            <label for="temps">Temps de préparation</label>
            <div class="input-group mb-3">
                <input required type="number" id="temps" name="TEMPS" class="form-control col-1">
                <div class="input-group-append">
                    <span class="input-group-text">min</span>
                </div>
            </div>
            <label for="cuisson">Temps de cuisson</label>
            <div class="input-group">
                <input required type="number" id="cuisson" name="CUISSON" class="form-control col-1">
                <div class="input-group-append">
                    <span class="input-group-text">min</span>
                </div>
            </div>
            <hr>
            <div class="input-group">
                <input required type="number" id="personne" name="personne" class="form-control col-1">
                <div class="input-group-append">
                    <span class="input-group-text">personnes</span>
                </div>
            </div>
            <hr>
            <p class="m-0">Difficulté</p>
            <div class="rating">
                <label>
                    <input required type="radio" name="DIFFICULTE" value="1"/>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input required type="radio" name="DIFFICULTE" value="2"/>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input required type="radio" name="DIFFICULTE" value="3"/>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input required type="radio" name="DIFFICULTE" value="4"/>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input required type="radio" name="DIFFICULTE" value="5"/>
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
                $(wrapper).append('<div class="input-group mt-3">\n' +
                    '  <input name="CONSIGNE[]" type="text" class="form-control" placeholder="Instruction de l\'étape" ' +
                    'aria-label="Instruction de l\'étape" aria-describedby="button-addon4">\n' +
                    '  <div class="input-group-append" id="button-addon4">\n' +
                    '  <button class="remove_field btn btn-outline-secondary" type="button">Supprimer</button></div>'); //add input box
                x++;
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text

            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        })
    });

</script>
