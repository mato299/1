<?php 

// 19€ na hraca
$pocetHracov = 0;
if(isset($_POST['pocet_hracov']))
{
    $pocetHracov = $_POST['pocet_hracov'];
}

$dieta_do6r = 0;
if(isset($_POST['dieta_do6r']))
{
    $dieta_do6r = $_POST['dieta_do6r'];
}

// isic -4€ skupinu (z celkovej sumy);
$isic = false;
if(isset($_POST['isic']))
{
    if($_POST['isic'] == 'ISIC')
    {
        $isic = true; 
    }
}

// 10% zľava (z celkovej sumy)
$zlava = 0;
if(isset($_POST['zlava']))
{
    $zlava = $_POST['zlava']; 
    //echo ("Zlava je:".$zlava);
}

// - xy €
$suma = 0;
if(isset($_POST['suma_darc_poukazu']))
{
    $suma = $_POST['suma_darc_poukazu'];
}

$vysledok = vypocetPlatby($pocetHracov, $dieta_do6r, $isic, $zlava, $suma);
//echo("mimo funkcie".$pocetHracov."<br>");

echo"Vysledok je $vysledok eur<br>";
echo "Pocet hracov je $pocetHracov, plus $dieta_do6r deti.<br>";
 if($zlava == 20){
        echo "zakaznik vyuzil 20 % zlavu";
    } elseif($zlava == 10){
     echo "zakaznik vyuzil 10 % zlavu<br>";
 }elseif($isic){
     echo "zakaznik vyuzil isic zlavu 4 eur <br>";
 }
if($suma){
    echo "zakaznik vyuzil darcekovu poukazku v hodnote $suma eur";
}


function vypocetPlatby($pocetHracov, $dieta_do6r, $isic, $zlava, $suma)
{
    $vysledok = 0;
   
    
    if(!is_numeric($pocetHracov))
    {
        return "error: nezadal si cislo";
    }

    if($pocetHracov <= 0)
    {
        return "error: hraci musia byt pozitivne cislo";
    }
    
    /*if($dieta_do6r = 0){
        return "0";
    }*/
   

    if(!is_numeric($zlava))
    {
        return "error: zlava nie je cislo";
    }
    //ak nemaju poukaz, nastavime sumu na 0
    if($suma == null){
        $suma = 0;
    }
    if(!is_numeric($suma))
    {
        return "error: poukaz nie je cislo";
    }


    $vysledok += $pocetHracov * 19;
    
    //ked je isic, nie je zlava
    if(!$isic){
    
    // odpocitame 10% zlavu
    if ($zlava == 10)
    {
        $vysledok *= 0.9;
    }

    if ($zlava == 20)
    {
        $vysledok *= 0.8;
    }
        }
    // odpocitame isic zlavu
    if($isic)
    {
        $vysledok -= 4;
    }
   
    
    if($suma > $vysledok){
        return "darcekovy poukaz nesmie byt vacsi ako celkova cena";
    }
    
   

    // odpocitame sumu poukaz
    $vysledok -= $suma;

    return $vysledok;
}

?>
