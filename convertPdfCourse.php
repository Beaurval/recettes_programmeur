<?php
session_start();
require_once 'dompdf/autoload.inc.php';
require_once 'dompdf/src/dompdf.php';
require_once "classes/Recette.php";
require_once "bdd.php";

ob_start();
include "maListedom.php";
$html = ob_get_clean();
ob_end_clean();

use Dompdf\Dompdf;
use Dompdf\Options;




// Utilisation du paquet DomPdf qui permet l'export en fichier PDF


$options = new Options();
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->set_option('isPhpEnabled', true);

$dompdf->load_html($html);

$dompdf->render();

$dompdf->stream('recette.pdf', array('Attachement'=>true));

?>