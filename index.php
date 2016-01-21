<?php
include_once 'head.html';
include_once 'nav.html';
?>


<div class="container theme-showcase" role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h3>Wprowadź kod produktu z ceneo.pl</h3>
        <p>
            <?php
            include_once('funkcje.php');
            if (isset($_SESSION['kod'])) {
                unset($_SESSION['kod']);
            }
            if (isset($_SESSION['pgs'])) {
                unset($_SESSION['pgs']);
            }
            if (isset($_SESSION['pgsCount'])) {
                unset($_SESSION['pgsCount']);
            }

            formularz();
            ?>
        </p>
    </div>

</div> <!-- /container -->


</body>
</html>
