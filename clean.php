<?php

session_start();
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';


echo '<h3>Czyszczenie bazy:</h3>';

include_once('funkcje.php');
czyscBaze();

include_once 'foot.html';



