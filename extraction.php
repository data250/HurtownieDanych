<?php

session_start();
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';

if (!isset($_SESSION['kod'])) {
    echo "Brak kodu w zmiennej sesji";
} else {
    include_once('funkcje.php');
    $kod = $_SESSION['kod'];
    $tab[] = extraction($kod);
    echo '<h3><span class="label label-success">Pobrano produkt z CENEO</span></h3>';

    //Pobieramy do zmiennych sesyjnych dane o produkcie
    $_SESSION['rodzaj'] = $tab[0]['rodzaj'];
    $_SESSION['marka'] = $tab[0]['marka'];
    $_SESSION['model'] = $tab[0]['model'];
    $_SESSION['opis'] = $tab[0]['opis'];
    
    //Wyświetlenie danych produktu
    echo'<table class="table table-striped"><tbody><tr><td>Kategoria: </td><td>';
    print_r($tab[0]['rodzaj']);
    echo'</td></tr><tr><td>Marka: </td><td>';
    print_r($tab[0]['marka']);
    echo'</td></tr><tr><td>Model: </td><td>';
    print_r($tab[0]['model']);
    echo'</td></tr><tr><td>Opis: </td><td>';
    print_r($tab[0]['opis']);
    echo'</td></tr></tbody>
          </table>';

    echo '<p><a href="transformation.php"><button type="button" class="btn btn-lg btn-primary">Krok 2: Transformation</button></a></p>';
    echo '<p><a href="load.php"><button type="button" class="btn btn-lg btn-success">Automatyczne ETL</button></a></p>';
}

include_once 'foot.html';

