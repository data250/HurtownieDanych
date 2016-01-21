<?php
session_start();
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';
include_once('funkcje.php');
if (isset($_POST["submit"])) { //sprawdza czy przeslany zostal formularz
    if (empty($_POST["kod"])) { //sprzawdza czy pole kod nie jest puste
        echo'<div class="alert alert-danger" role="alert">
        <strong>Błąd!</strong> Puste pole kodu.
      </div>';

        formularz();
    } elseif (!is_numeric($_POST["kod"])) { //sprawdza czy pole kod zawiera tylko cyfry
        echo'<div class="alert alert-danger" role="alert">
        <strong>Błąd!</strong> Kod musi zawierać tylko i wyłącznie cyfry.
      </div>';


        formularz();
    } else {
        $kod = $_POST["kod"];


        if (!isset($_SESSION['kod'])) { //sprawdza czy istnieje zmienna sesyjna 'kod' 
            $_SESSION['kod'] = $kod; //jeżeli nie to zostaje ona utworzona
        }
        ?>

        <h3>Sprawdzanie kodu w bazie</h3>

        <li>Kod: <b><?= trim($kod); ?></b></li>



        <?php
        if (istnieje($kod)) { //jeśli kod istnieje w bazie danych
            echo'<div class="alert alert-warning" role="alert">
        <strong>Uwaga!</strong> Towar o podanym kodzie istnieje w bazie.
      </div>';
            echo '<p><a href="opinions.php?kod=' . $kod . '"><button type="button" class="btn btn-lg btn-success">Pokaż opinie o tym produkcie</button></a></p>';
        } else { //jeżeli kodu produktu nie ma
            echo'<div class="alert alert-info" role="alert">
        <strong>Oh!</strong> Produkt o podanym kodzie nie istnieje, rozpocznij proces ETL.
      </div>';
            echo '<p><a href="extraction.php"><button type="button" class="btn btn-lg btn-primary">Krok 1: Extraction</button></a></p>';
            echo '<p><a href="load.php"><button type="button" class="btn btn-lg btn-success">Automatyczne ETL</button></a></p>';
        }
    }
} else { //przekierowanie do formularza jeżeli użytkownik wszedł na tą stronę bez przesłania go
    header("Location: index.php");
}
include_once 'foot.html';
?>

