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
        $ceneo = 'http://www.ceneo.pl/';
        $kod = 27472709;
        $adres = $ceneo . $kod;
        
        //Badanie ilości stron
        $html = file_get_html($adres); //tymczasowy adres
        $reviewCount = $html->find('span[itemProp=reviewCount]');
        foreach ($reviewCount as $rv) {
            $reviews = $rv->innertext;
        }
        $pages = $reviews/10;
        
        
        for($i=1;$i<$pages+1;$i++)
        {
            echo $i;
          $html = file_get_html($adres . '/opinie-' . $i);
          $nicks = $html->find('div.product-reviewer');
          foreach ($nicks as $nick) {
            echo $nick->innertext;
            
        }
        unset($html, $nicks);
          
        }
        
     
        
        ?>
    </body>
</html>
