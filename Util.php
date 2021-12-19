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

    public static function echoOldBr($how_many) // povinna premenna
    {
        for ($i=0; $i < $how_many; $i++) {
            echo('<br>-'.$how_many.'x ');
            echo('NOVY RIADOK');
            echo('-<br>');
        }
    }    

    public static function echoOldBr1() // ziadna premenna
    {
        $how_many = 1;
        for ($i=0; $i < $how_many; $i++) {
            echo('<br>-'.$how_many.'x ');
            echo('NOVY RIADOK');
            echo('-<br>');
        }
    }

    public static function echoOldBr2()
    {
        $how_many = 2;
        for ($i=0; $i < $how_many; $i++) {
            echo('<br>-'.$how_many.'x ');
            echo('NOVY RIADOK');
            echo('-<br>');
        }
    }

    public static function echoOldBr3() 
    {
        $how_many = 3;
        for ($i=0; $i < $how_many; $i++) {
            echo('<br>-'.$how_many.'x ');
            echo('NOVY RIADOK');
            echo('-<br>');
        }
    }

    public static function echoOldBr6()
    {
        $how_many = 6;
        for ($i=0; $i < $how_many; $i++) {
            echo('<br>-'.$how_many.'x ');
            echo('NOVY RIADOK');
            echo('-<br>');
        }
    }
}

?>