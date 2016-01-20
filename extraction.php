<?php
session_start(); 
if (!isset($_SESSION['kod'])) { 
            //brak kodu   
    echo "BRAK";
        } else {
          include_once('funkcje.php'); 
          $kod=$_SESSION['kod'];
          $tab[]= extraction($kod);
          echo "Pobrano produkt z ceneo.pl:<br>";
          
          $_SESSION['rodzaj']=$tab[0]['rodzaj'];
          $_SESSION['marka']=$tab[0]['marka'];
          $_SESSION['model']=$tab[0]['model'];
          $_SESSION['opis']=$tab[0]['opis'];
          
          print_r('Rodzaj:'.$tab[0]['rodzaj'].'<br>');
          print_r('Marka:'.$tab[0]['marka'].'<br>');
          print_r('Model:'.$tab[0]['model'].'<br>');
          print_r('opis:'.$tab[0]['opis'].'<br>');   
          
          
          echo "<p><a href=\"transform.php\">Transformation</a></p>";
        }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

