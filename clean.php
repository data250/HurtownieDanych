<?php
session_start(); 
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';

 include_once('connect.php');
 echo '<h3>Czyszczenie bazy:</h3>';
   $wynik = mysql_query('TRUNCATE `opinie`') 
or die('Błąd zapytania'); 
      $wynik = mysql_query('TRUNCATE `produkt`') 
or die('Błąd zapytania'); 


       
      
         
        
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

