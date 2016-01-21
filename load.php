<?php
session_start(); 
include_once('funkcje.php');
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';
include_once('funkcje.php');
if (!isset($_SESSION['kod'])){
    
}  else {
    $kod = $_SESSION['kod'];
    
       echo '<h3>Przetwarzanie</h3>';
        loadProduct($kod); 
       
     
    if (!isset($_SESSION['pgs'])){
        $opinie = countReviews($kod);
        $offset = 0;
        $strony = ceil($opinie/10);
                
        $_SESSION['pgs'] = $strony;
        $_SESSION['pgsCount'] = 0;
       echo ' <div class="alert alert-warning" role="alert">
        <strong>Praca w toku!</strong> Dodawanie produktu do bazy.
        </div>';
        
        loadProduct($kod); 
       header('refresh: 1;');
    } elseif ($_SESSION['pgsCount']<$_SESSION['pgs']) {
        echo ' <div class="alert alert-warning" role="alert">
        <strong>Praca w toku!</strong> Dodawanie opinii do bazy.<br>';
      
         print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']."</div>");
         loadOpinions($kod, $_SESSION['pgsCount'], 10);
        header('refresh: 0.2;');
        $_SESSION['pgsCount']++;
    } else{
        
         print_r("Strona ".$_SESSION['pgsCount']." z ".$_SESSION['pgs']."<br>");
         $opinie = countReviews($kod);
        $offset = substr( $opinie, -1, 1 );
                 loadOpinions($kod, $_SESSION['pgsCount'], $offset-1);
         echo '<div class="alert alert-success" role="alert">
        <strong>Zakończono!</strong>Produkt wraz z opiniami został zapisany w bazie.
      </div>';
            unset($_SESSION['kod']);
            unset($_SESSION['pgs']);
            unset($_SESSION['pgsCount']);

         $_SESSION = array();
        echo "<p><a href=\"load.php\">Load</a></p>";
    }
    
}
$max = $_SESSION['pgs'];
$current = $_SESSION['pgsCount'];
if($max!=0){
$percentage = ($current/$max)*100;    
}else{
$current=100;
$max=100;
$percentage = ($current/$max)*100;
}

echo '<div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$current.'" aria-valuemin="0" aria-valuemax="'.$max.'" style="width: '.$percentage.'%"><span class="sr-only">40% Complete (success)</span></div>
      </div>';
     
    
    
  
    
            // print_r('Autor:'.$tab[2]['nick'].'<br>');

  //  print_r($tab);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



