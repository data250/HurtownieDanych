<?php
session_start();
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';
include_once('funkcje.php');
if (isset($_POST["submit"])) {



    if (empty($_POST["kod"])) {

        echo'<div class="alert alert-danger" role="alert">
        <strong>Błąd!</strong> Puste pole kodu.
      </div>';

        formularz();
    } elseif (!is_numeric($_POST["kod"])) {
        echo'<div class="alert alert-danger" role="alert">
        <strong>Błąd!</strong> Kod musi zawierać tylko i wyłącznie cyfry.
      </div>';


        formularz();
    } else {
        $kod = $_POST["kod"];


        if (!isset($_SESSION['kod'])) {
            $_SESSION['kod'] = $kod;
        } else {
            //tmp        
        }
        ?>

        <h3>Sprawdzanie kodu w bazie</h3>



        <li>Kod: <b><?= trim($kod); ?></b></li>



        <?php
        if (istnieje($kod)) {
            echo'<div class="alert alert-warning" role="alert">
        <strong>Uwaga!</strong> Towar o podanym kodzie istnieje w bazie.
      </div>';
        } else {
            echo'<div class="alert alert-info" role="alert">
        <strong>Oh!</strong> Produkt o podanym kodzie nie istnieje, rozpocznij proces ETL.
      </div>';
            echo '<p><a href="extraction.php"><button type="button" class="btn btn-lg btn-primary">Krok 1: Extraction</button></a></p>';
            echo '<p><a href="etl.php"><button type="button" class="btn btn-lg btn-success">Automatyczne ETL</button></a></p>';
        }
    }
} else {



    header("Location: index.php");
}
?>

