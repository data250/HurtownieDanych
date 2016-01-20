<?php
 include_once('funkcje.php'); 
 if (isset($_POST["submit"])) {

  

    if (empty($_POST["kod"])){    

      echo "<p style=\"color:red\">Puste pole!</p>";

      echo "<p><a href=\"index.php\">Powrót do wpiszwania kodu</a></p>";
    }elseif (!is_numeric($_POST["kod"])){
        echo "<p style=\"color:red\">Kody towarów muszą być numeryczne (0-9)!</p>";
    } else {
    
      ?>

      <h3>Sprawdzam bazę!</h3>

      

      <li>Kod: <b><?= trim($_POST["kod"]); ?></b></li>

     

      <?php
      if (istnieje($_POST["kod"])){
          echo "Produkt istnieje w bazie danych. Przejdz pod link:<br>";
          echo "<p><a href=\"produkt.php\">Powrót do wpiszwania kodu</a></p>";
          
      }else{
          echo "Rozpocznij proces ETL";
          $tab[]= extraction($_POST["kod"]);
          print_r('Rodzaj:'.$tab[0]['Rodzaj']);
          print_r('Marka:'.$tab[0]['marka']);
          print_r('Model:'.$tab[0]['model']);
          print_r('opis:'.$tab[0]['opis']);
      }
     
    }

  } else {

    // Jeśli użytkownik dostał się na tę stronę w sposób inny niż przez formularz

    // zostaje przekierowany do formularza zgłoszenia

    header("Location: index.php");

  }

?>

