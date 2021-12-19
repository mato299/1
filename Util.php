<?php

class Util
{
    public static function getUrlFull(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
 
    public static function echoNewBr($how_many = 1) // nepovinna premenna
    {
        for ($i=0; $i < $how_many; $i++) {
            echo('<br>-'.$how_many.'x ');
            echo('NOVY RIADOK');
            echo('-<br>');
        }
    }

    public static function echoNadpis($textNazobrazenie) {
        echo "<h1>"$textNazobrazenie"</h1>";
    }
   public static function echoNadpis2($textNazobrazenie2) {
       echo "<h2>"$textNazobrazenie2"</h2>";
   }

}

?>