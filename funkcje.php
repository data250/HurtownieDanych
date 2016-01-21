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

function istnieje($kod) {
    include_once('connect.php');
    $zapytanie = mysql_query("SELECT * FROM produkt WHERE kod=$kod");
    $wynik = mysql_fetch_array($zapytanie);
    if (empty($wynik)) {
        echo "Nie znaleziono towaru";
        return 0;
    } else {
        echo "Znaleziono";
        return 1;
    }
    print_r($wynik);
    return 0;
}

function extraction($id) {
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

function transformation($kod, $page) {
    include_once('simple_html_dom.php');
    $ceneo = 'http://www.ceneo.pl/';
    $adres = $ceneo . $kod;
    $html = file_get_html($adres); //tymczasowy adres

    $html = file_get_html($adres . '/opinie-' . $page);
    $nicks = $html->find('div.product-reviewer');
    foreach ($nicks as $nick) {
        $tab['nick'][] = $nick->innertext;
    }
    $scores = $html->find('span.review-score-count');
    foreach ($scores as $score) {
//print_r('TEST:'.$score->innertext.':TEST');
        $tab['score'][] = $score->innertext;
    }
    $pross = $html->find('span.pros-cell');
    foreach ($pross as $pros) {
        $tab['pros'][] = $pros->innertext;
    }
    $conss = $html->find('span.cons-cell');
    foreach ($conss as $cons) {
        $tab['cons'][] = $cons->innertext;
    }
    $tresc = $html->find('p.product-review-body');
    foreach ($tresc as $post) {
        $tab['post'][] = $post->innertext;
    }
    $recommended = $html->find('div.reviewer-recommendation > div > em');
    foreach ($recommended as $rcm) {
        $tab['rcm'][] = $rcm->innertext;
    }
    $yesv = $html->find('span.product-review-usefulness-stats');
    foreach ($yesv as $yes) {
        $tab['yes'][] = $yes->children(1)->innertext;
        $tab['all'][] = $yes->children(2)->innertext;
    }
    $time = $html->find('time');
    foreach ($time as $tm) {
        $tab['time'][] = $tm->datetime;
    }
    return $tab;
}

function transformationShow($kod, $page) {

    $tab[] = transformation($kod, $page);
    echo "<pre>";
//print_r($tab);
    echo "</pre>";
    for ($i = 0; $i < 10; $i++) {
        print_r('Autor:' . $tab[0]['nick'][$i] . '<br>');
        print_r('Ocena:' . $tab[0]['score'][$i] . '<br>');
        print_r($tab[0]['pros'][$i] . '<br>');
        print_r($tab[0]['cons'][$i] . '<br>');
        print_r('Treść:' . $tab[0]['post'][$i] . '<br>');
        print_r('Rekomendacja:' . $tab[0]['rcm'][$i] . '<br>');
        if ($tab[0]['all'][$i] != 0) {
            print_r('Użyteczność:' . $tab[0]['yes'][$i] . '<br>');
            print_r('Oceniło:' . $tab[0]['all'][$i] . '<br>');
            $procent = $tab[0]['yes'][$i] / $tab[0]['all'][$i];
            print_r('Procentowo: ' . $procent * 100);
            print_r('%<br>');
        }

        print_r('Czas dodania:' . $tab[0]['time'][$i] . '<br>');
        print_r('<hr>');
    }
}

function countReviews($kod) {
    include_once('simple_html_dom.php');
    $ceneo = 'http://www.ceneo.pl/';
    $adres = $ceneo . $kod;
    $html = file_get_html($adres); //tymczasowy adres
    $reviewCount = $html->find('span[itemProp=reviewCount]');
    foreach ($reviewCount as $rv) {
        $reviews = $rv->innertext;
    }
    return $reviews;
}

function loadProduct($kod) {
    $tab[] = extraction($kod);
    include_once('connect.php');
    $rodzaj = "b/d";
    $model = "b/d";
    $marka = "b/d";
    $opis = "b/d";
    $rodzaj = $tab[0]['rodzaj'];
    $marka = $tab[0]['marka'];
    $model = $tab[0]['model'];
    $opis = $tab[0]['opis'];
    $query = "INSERT INTO produkt VALUES ('$kod', '$rodzaj' , '$marka', '$model', '$opis')";
    print_r($query);
    mysql_query($query);
    return true;
}

function loadOpinions($kod, $page, $offset) {
    include_once('connect.php');
    $tab[] = transformation($kod, $page);
    if($offset == 0){
        $end = 10;
    }else{
        $end = $offset;
    }
    for ($i = 0; $i < $end; $i++) {
        $wady = $tab[0]['cons'][$i];
        $zalety = $tab[0]['pros'][$i];
        $podsumowanie = $tab[0]['post'][$i];
        $gwiazdki = $tab[0]['score'][$i];
        $autor = $tab[0]['nick'][$i];
        $data = $tab[0]['time'][$i];
        $polecenie = $tab[0]['rcm'][$i];
        $przydatnosc = $tab[0]['yes'][$i];
        $ocenilo = $tab[0]['all'][$i];
        
        $query = "INSERT INTO `opinie` VALUES (NULL, '$kod', '$wady', '$zalety',"
                . " '$podsumowanie', '$gwiazdki', '$autor', '$data', '$polecenie',"
                . " '$przydatnosc', '$ocenilo')";
        //print_r($query);
        mysql_query($query);

       

    }
}
