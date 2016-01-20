<?php
session_start(); 
include_once('funkcje.php');
if (!isset($_SESSION['kod'])){
    
}  else {
    
    print_r("Rodzaj: ".$_SESSION['rodzaj']."<br>");
    print_r("Marka: ".$_SESSION['marka']."<br>");
    print_r("Model: ".$_SESSION['model']."<br>");
    print_r("Opis: ".$_SESSION['opis']."<br>");
    
          
    
    if (!isset($_SESSION['pgs'])){
        $kod = $_SESSION['kod'];
        $_SESSION['pgs'] = countReviews($kod)/10;
        $_SESSION['pgsCount'] = 1;
        print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']."<br>");
        echo "<p><a href=\"transformation.php\">Następna strona</a></p>";
        echo "<p><a href=\"load.php\">Load</a></p>";
        transformationShow($kod, 0);
    } elseif ($_SESSION['pgsCount']<$_SESSION['pgs']) {
        $kod = $_SESSION['kod'];
         print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']."<br>");
        echo "<p><a href=\"transformation.php\">Następna strona</a></p>";
        echo "<p><a href=\"load.php\">Load</a></p>";
        transformationShow($kod, $_SESSION['pgsCount']);
        $_SESSION['pgsCount']++;
    } else{
         print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']."<br>");
        echo "<p><a href=\"transformation.php\">Następna strona</a></p>";
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

