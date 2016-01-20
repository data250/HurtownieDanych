<?php
session_start(); 
 include_once('funkcje.php'); 
 if (isset($_POST["submit"])) {

  

    if (empty($_POST["kod"])){    

      echo "<p style=\"color:red\">Puste pole!</p>";

      echo "<p><a href=\"index.php\">Powrót do wpiszwania kodu</a></p>";
    }elseif (!is_numeric($_POST["kod"])){
        echo "<p style=\"color:red\">Kody towarów muszą być numeryczne (0-9)!</p>";
    } else {
        $kod = $_POST["kod"];
          

        if (!isset($_SESSION['kod'])) { 
            $_SESSION['kod'] = $kod;     
        } else {                          
            //tmp        
        }
    
      ?>

      <h3>Sprawdzanie kodu w bazie</h3>

      

      <li>Kod: <b><?= trim($kod); ?></b></li>

     

      <?php
      if (istnieje($kod)){
          echo "Produkt istnieje w bazie danych. Przejdz pod link:<br>";
          echo "<p><a href=\"produkt.php\">Powrót do wpiszwania kodu</a></p>";
          
      }else{
          echo "Produkt nie istnieje w bazie danych.<br>"
          . "Rozpocznij proces ETL";
          echo "<p><a href=\"extraction.php\">Extraction</a></p>";
          echo "<p><a href=\"etl.php\">Cały proces ETL</a></p>";
          
          
      }
     
    }

  } else {



    header("Location: index.php");

  }

?>

