<?php 

// 19€ na hraca
$pocetHracov = 0;
if(isset($_POST['pocet_hracov']))
{
    $pocetHracov = $_POST['pocet_hracov'];
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

$vysledok = vypocetPlatby($pocetHracov, $isic, $zlava, $suma);
//echo("mimo funkcie".$pocetHracov."<br>");

echo("Vysledok je $vysledok");


function vypocetPlatby($pocetHracov, $isic, $zlava, $suma)
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

    if(!is_numeric($zlava))
    {
        return "error: zlava nie je cislo";
    }

    if(!is_numeric($suma))
    {
        return "error: poukaz nie je cislo";
    }


    $vysledok += $pocetHracov * 19;
    
    // odpocitame 10% zlavu
    if ($zlava == 10)
    {
        $vysledok *= 0.9;
    }

    if ($zlava == 20)
    {
        $vysledok *= 0.8;
    }

    // odpocitame isic zlavu
    if($isic)
    {
        $vysledok -= 4;
    }

    // odpocitame sumu poukaz
    $vysledok -= $suma;

    return $vysledok;
}

?>