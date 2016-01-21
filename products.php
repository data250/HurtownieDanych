<?php
session_start(); 
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';

 include_once('connect.php');
   $wynik = mysql_query("SELECT * FROM produkt") 
or die('Błąd zapytania'); 

if(mysql_num_rows($wynik) > 0) { 
 echo '<p><a href="clean.php"><button type="button" class="btn btn-lg btn-danger">WYCZYŚĆ BAZĘ</button></a></p>';

    echo '<table class="table table-striped">
        <thead>
              <tr>
                <th>KOD</th>
                <th>Kategoria</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Opis</th>
              </tr>
            </thead> 
            <tbody>'; 
    while($r = mysql_fetch_assoc($wynik)) { 
        echo "<tr>"; 
        $kod = $r['kod'];
        echo '<td><a href="opinions.php?kod='.$kod.'">'.$kod.'</a></td>'; 
        echo "<td>".$r['rodzaj']."</td>"; 
        echo "<td>".$r['marka']."</td>"; 
        echo "<td>".$r['model']."</td>"; 
        echo "<td>".$r['dodatkowe']."</td>"; 

        echo "</tr>"; 
    } 
    echo '</tbody>
          </table>'; 
}        
         
           
             
         
          
         
            
            
         
        
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

