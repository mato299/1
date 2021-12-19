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
            // echo('<br>-'.$how_many.'x ');
            // echo('NOVY RIADOK');
            // echo('-<br>');
            echo('<br>');
        }
    }

    public static function echoNadpis($textNazobrazenie, $color, $Hkolko, $font) {
        echo ('<'.$Hkolko.' style="color:'.$color.'; font-size: '.$font.'px;"> '.$Hkolko . ''. $textNazobrazenie.'</'.$Hkolko.'>');
}
}
?>