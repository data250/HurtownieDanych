<?php
function formularz() {

  $form = <<<EOD

    <form action="kod.php" method="post">

    <div>

    KOD produkty: <input name="kod" value="" /><br />

    

    <input type="submit" value="Wyślij" name="submit"/>

    </div>

    </form>

EOD;

    echo $form;

  }
  
function istnieje($kod){
    include_once('connect.php'); 
    $zapytanie = mysql_query("SELECT * FROM produkt WHERE kod=$kod");
    $wynik = mysql_fetch_array($zapytanie);
     if (empty($wynik)){
         echo "Nie znaleziono towaru";
         return 0;
     }else {
         echo "Znaleziono";
         return 1;
     }
    print_r($wynik);
return 0;


    
}

function extraction($id){
     include_once('simple_html_dom.php'); 
        
        
        $ceneo = 'http://www.ceneo.pl/';
        $kod = $id;
        $adres = $ceneo . $kod;
        $html = file_get_html($adres); //tymczasowy adres
                
                
                //dane urządzenia
                $rodzaj = $html->find('//*[@id="body"]/div[1]/nav/dl/dd/span[4]/a/span');
                foreach ($rodzaj as $ro) {
                    $tab['rodzaj'] = $ro->innertext;
                }
                $marka = $html->find('//*[@id="productTechSpecs"]/div[1]/table/tbody/tr/td/ul/li/a');
                foreach ($marka as $mk) {
                    $tab['marka'] = $mk->innertext;
                }
                $model = $html->find('//*[@id="body"]/div[2]/div/div/div[1]/article/div[2]/h1');
                foreach ($model as $md) {
                    $tab['model'] = $md->innertext;
                }
                $opis = $html->find('//*[@id="body"]/div[2]/div/div/div[1]/article/div[2]/div[1]/text()');
                foreach ($opis as $op) {
                    $tab['opis'] = $op->innertext;
                }
        return $tab;
               
}
