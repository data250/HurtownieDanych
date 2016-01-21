<?php
session_start(); 
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';

 include_once('connect.php');
 $kod= $_GET['kod'];
   $wynik = mysql_query('SELECT * FROM `opinie` WHERE `id_produkt` = '.$kod.' ORDER BY `id` ASC') 
or die('Błąd zapytania'); 
echo '<h3>Opinie o produkcie:</h3>';
 echo '<a href="csv.php?kod='.$kod.'"><button type="button" class="btn btn-lg btn-warning">DO CSV</button></a>';
  echo '<hr>'  ;       
if(mysql_num_rows($wynik) > 0) { 

    while($r = mysql_fetch_assoc($wynik)) { 
        echo 'Autor:' . $r['autor'] . '<br>';
        echo 'Data:' . $r['data'] . '<br>';
        echo 'Ocena:' . $r['gwiazdki'] . '<br>';
        echo 'Rekomendacja:' . $r['polecenie'] . '<br>';
        echo $r['zalety'] . '<br>';
        echo $r['wady'] . '<br>';
        echo 'Podsumowanie:' . $r['podsumowanie'] . '<br>';
         echo 'Przydatność opini (uznało za prydatną/łącznie głosów):' . $r['przydatna'] .'/'. $r['ocenilo'] . '<br>';

   
        echo '<hr>'; 
    } 
    echo '<hr>'; 
    
}        
      

