<?php
session_start(); 
include_once('funkcje.php');
if (!isset($_SESSION['kod'])){
    
}  else {
    $kod = $_SESSION['kod'];
    
        print_r("Dodawanie produktu.");
        loadProduct($kod); 
       
     
    if (!isset($_SESSION['pgs'])){
        $opinie = countReviews($kod);
        $offset = 0;
        $strony = ceil($opinie/10);
                
        $_SESSION['pgs'] = $strony;
        $_SESSION['pgsCount'] = 0;
        print_r("Dodawanie produktu.");
        loadProduct($kod); 
       header('refresh: 1;');
    } elseif ($_SESSION['pgsCount']<$_SESSION['pgs']) {
        
         print_r("Dodawanie opinii. Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']."<br>");
         loadOpinions($kod, $_SESSION['pgsCount'], 10);
        header('refresh: 0.2;');
        $_SESSION['pgsCount']++;
    } else{
        
         print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']."<br>");
         $opinie = countReviews($kod);
        $offset = substr( $opinie, -1, 1 );
                 loadOpinions($kod, $_SESSION['pgsCount'], $offset-1);
         print_r("Zakończono");        
        echo "<p><a href=\"load.php\">Load</a></p>";
    }
    
}
     
    
    
  
    
            // print_r('Autor:'.$tab[2]['nick'].'<br>');

  //  print_r($tab);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



