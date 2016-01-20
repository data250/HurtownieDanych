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
     
        echo "Zmienna:".$_SESSION['pgs']."<br>";
        
        if ($_SESSION['pgs'] == -1) 
            {

                //Badanie ilości stron
                $html = file_get_html($adres); //tymczasowy adres
                $reviewCount = $html->find('span[itemProp=reviewCount]');
                foreach ($reviewCount as $rv) {
                    $reviews = $rv->innertext;
                }
                $pages = $reviews/10;
                $_SESSION['pgs']=$pages;
        } elseif ($_SESSION['pgs'] == 0)
        {
            echo "Zakończono";
        } else
        {
            
            $html = file_get_html($adres . '/opinie-' . $_SESSION['pgs']);
            $nicks = $html->find('div.product-reviewer');
            foreach ($nicks as $nick) {
                echo $nick->innertext;
            }
            $_SESSION['pgs']--;
            header('refresh: 1;');
        }

        ?>
    </body>
</html>
