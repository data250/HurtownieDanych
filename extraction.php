<?php
session_start(); 
include_once 'head.html';
include_once 'nav.html';
echo '<div class="container theme-showcase" role="main">';
echo '<div class="jumbotron">';
if (!isset($_SESSION['kod'])) { 
            //brak kodu   
    echo "BRAK";
        } else {
          include_once('funkcje.php'); 
          $kod=$_SESSION['kod'];
          $tab[]= extraction($kod);
          echo '<h3><span class="label label-success">Pobrano produkt z CENEO</span></h3>';
          
          $_SESSION['rodzaj']=$tab[0]['rodzaj'];
          $_SESSION['marka']=$tab[0]['marka'];
          $_SESSION['model']=$tab[0]['model'];
          $_SESSION['opis']=$tab[0]['opis'];
          echo'<table class="table table-striped"><tbody><tr><td>Kategoria: </td><td>';  
          print_r($tab[0]['rodzaj']);
          echo'</td></tr><tr><td>Marka: </td><td>';
          print_r($tab[0]['marka']);
          echo'</td></tr><tr><td>Model: </td><td>';
          print_r($tab[0]['model']);
          echo'</td></tr><tr><td>Opis: </td><td>';
          print_r($tab[0]['opis']);   
          echo'</td></tr></tbody>
          </table>';
          
          echo '<p><a href="transformation.php"><button type="button" class="btn btn-lg btn-primary">Krok 2: Transformation</button></a></p>';
            echo '<p><a href="etl.php"><button type="button" class="btn btn-lg btn-success">Automatyczne ETL</button></a></p>';
            
            
         
        }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

