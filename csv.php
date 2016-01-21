<?php
session_start(); 
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';


echo '<h3>Export do CSV:</h3>';

 $kod= $_GET['kod'];
    include_once('funkcje.php');
    dane_do_CSV($kod);
    echo'<div class="alert alert-success" role="alert">
        <strong>Eksport wykonany!</strong> Możesz pobrać wyeksportowane pliki CSV z poniższego folderu:
      </div>';
    echo '<a href="csv/"><button type="button" class="btn btn-lg btn-warning">Pliki CSV</button></a>';
 
      

