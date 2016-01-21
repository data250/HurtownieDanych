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
                
                echo '<p><br><a href="ProjektETL-DokumentacjaTechniczna.pdf"><button type="button" class="btn btn-lg btn-danger">Dokumentacja Techniczna (PDF)</button></a><br><br>';
                   
                echo '<a href="Projekt_ETL-DokumentacjaUzytkownika.pdf"><button type="button" class="btn btn-lg btn-danger">Dokumentacja Użytkownika (PDF)</button></a></p>';
                
                
            ?>
        </p>

<?php
include_once 'foot.html';
?>