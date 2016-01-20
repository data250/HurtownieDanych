
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once('simple_html_dom.php'); 
        session_start();  

        if (!isset($_SESSION['pgs'])) { 
            $_SESSION['pgs'] = -1;      
        } else {                          
            //$_SESSION['pgs']--;        
        }
        
        $ceneo = 'http://www.ceneo.pl/';
        $kod = 27472709;
        $adres = $ceneo . $kod;
        $html = file_get_html($adres); //tymczasowy adres
                
                
                //dane urządzenia
                $rodzaj = $html->find('//*[@id="body"]/div[1]/nav/dl/dd/span[4]/a/span');
                foreach ($rodzaj as $ro) {
                    echo $ro->innertext.'<br>';
                }
                $marka = $html->find('//*[@id="productTechSpecs"]/div[1]/table/tbody/tr/td/ul/li/a');
                foreach ($marka as $mk) {
                    echo $mk->innertext.'<br>';
                }
                $model = $html->find('//*[@id="body"]/div[2]/div/div/div[1]/article/div[2]/h1');
                foreach ($model as $md) {
                    echo $md->innertext.'<br>';
                }
                $opis = $html->find('//*[@id="body"]/div[2]/div/div/div[1]/article/div[2]/div[1]/text()');
                foreach ($opis as $op) {
                    echo $op->innertext.'<br>';
                }
               
                
     
        echo "Zmienna:".$_SESSION['pgs']."<br>";
        
        if ($_SESSION['pgs'] == -1) 
            {

                
                
                $rodzaj = $html->find('#linked-categories > ul > li:nth-child(2) > a');
                foreach ($rodzaj as $ro) {
                    echo $ro->innertext;
                }
                //Badanie ilości stron
                $reviewCount = $html->find('span[itemProp=reviewCount]');
                foreach ($reviewCount as $rv) {
                    $reviews = $rv->innertext;
                }
                $pages = $reviews/10;
                $_SESSION['pgs']=$pages;
                
               
        } elseif ($_SESSION['pgs'] == 0)
        {
            unset($_SESSION['pgs']);
            echo "Zakończono";
        } else
        {
            $html = file_get_html($adres . '/opinie-' . $_SESSION['pgs']);
            $nicks = $html->find('div.product-reviewer');
            foreach ($nicks as $nick) {
                echo $nick->innertext;
                $tab['nick'][] = $nick->innertext;
            }
            $scores = $html->find('span.review-score-count');
            foreach ($scores as $score) {
                echo $score->innertext;
                $tab['score'][] = $score->innertext;
            }
            $pross = $html->find('span.pros-cell');
            foreach ($pross as $pros) {
                echo $pros->innertext;
            }
            $conss = $html->find('span.cons-cell');
            foreach ($conss as $cons) {
                echo $cons->innertext;
            }
            $tresc = $html->find('div.content-wide-col');
            foreach ($tresc as $post) {
               // echo $post->innertext;
            }
            $recommended = $html->find('div.reviewer-recommendation > div > em');
            foreach ($recommended as $rcm) {
               echo $rcm->innertext;
            }
            $yesv = $html->find('span.product-review-usefulness-stats');
            foreach ($yesv as $yes) {
               echo $yes->children(1)->innertext;
               echo '/';
               echo $yes->children(2)->innertext;
            }
            $time = $html->find('time');
            foreach ($time as $tm) {
               echo $tm->datetime;
            }
             
           
            
           
            $_SESSION['pgs']--;
            header('refresh: 1;');
        }
        ?>
    </body>
</html>
