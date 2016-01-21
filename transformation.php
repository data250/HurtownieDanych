<?php
session_start(); 
include_once('funkcje.php');
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';
if (!isset($_SESSION['kod'])){
    
}  else {
     $kod = $_SESSION['kod'];
    echo'<table class="table table-striped"><tbody><tr><td>Kategoria: </td><td>';  
    print_r($_SESSION['rodzaj']);
    echo'</td></tr><tr><td>Marka: </td><td>';
    print_r($_SESSION['marka']);
    echo'</td></tr><tr><td>Model: </td><td>';
    print_r($_SESSION['model']);
    echo'</td></tr><tr><td>Opis: </td><td>';
    print_r($_SESSION['opis']);   
     echo'</td></tr><tr><td>Opinie do załadowania: </td><td>';
    print_r(countReviews($kod));   
    echo'</td></tr></tbody>
    </table>';
 
    
          
   
    if (!isset($_SESSION['pgs'])){
       
        $strony = ceil(countReviews($kod)/10);
        $_SESSION['pgs'] = $strony;
        $_SESSION['pgsCount'] = 1;
        print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']);
         echo '<p><a href="transformation.php"><button type="button" class="btn btn-lg btn-warning">Następna strona</button></a></p>';
         echo '<p><a href="load.php"><button type="button" class="btn btn-lg btn-primary">Krok 3: Load</button></a></p>';
         $opinie = countReviews($kod);
        $offset = substr( $opinie, -1, 1 );
        transformationShow($kod, 0, $offset);
    } elseif ($_SESSION['pgsCount']<$_SESSION['pgs']) {
        
         print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']);
        echo '<p><a href="transformation.php"><button type="button" class="btn btn-lg btn-warning">Następna strona</button></a></p>';
         echo '<p><a href="load.php"><button type="button" class="btn btn-lg btn-primary">Krok 3: Load</button></a></p>';
         $opinie = countReviews($kod);
        $offset = substr( $opinie, -1, 1 );
        transformationShow($kod, $_SESSION['pgsCount'], $offset);
        $_SESSION['pgsCount']++;
    } else{
         print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']);
          echo '<p><a href="load.php"><button type="button" class="btn btn-lg btn-primary">Krok 3: Load</button></a></p>';
        
    }
    
}
     
    
    
  
    
            // print_r('Autor:'.$tab[2]['nick'].'<br>');

  //  print_r($tab);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

