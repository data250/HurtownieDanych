<?php
include_once 'head.html';
include_once 'nav.html';
?>

<div class="container theme-showcase" role="main">

    <div class="jumbotron">
        <h3>Wprowadź kod produktu z ceneo.pl</h3>
        <p>
            <?php
                include_once('funkcje.php');
                czyscZmienne();
                formularz();
            ?>
        </p>

<?php
include_once 'foot.html';
?>