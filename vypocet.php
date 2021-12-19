<?php
    require_once('Util.php'); // include
    
    const BEZ_ZLAVY = 0;
    const PERC_20 = 1;
    const PERC_10 = 2;
    const ISIC = 3;


    echoNadpis();










// 19€ na hraca
$pocetHracov = 0;
if(isset($_POST['pocet_hracov']))
{
    $pocetHracov = $_POST['pocet_hracov'];
}


$dieta_do6r = 0;
if(isset($_POST['dieta_do6r']) 
    && $_POST['dieta_do6r'] != null 
    && is_numeric($_POST['dieta_do6r']) )
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
}

// - xy €
$suma = 0;
if(isset($_POST['suma_darc_poukazu']))
{
    $suma = $_POST['suma_darc_poukazu'];
}

$vysledok = vypocetPlatby($pocetHracov, $dieta_do6r, $isic, $zlava, $suma);


// Ak je vysledok cislo, vypiseme ho ze kolko eur maju platit
if(is_numeric($vysledok))
{
    echo "Platba je $vysledok eur<br>";
}
// Ak nebol vysledok cislo, tak to bude nejaka Chybová hláška. Zobrazíme error
else
{
    echo "Error: $vysledok<br>"; //
}

echo "Pocet hracov je $pocetHracov, plus $dieta_do6r deti.<br>";

echo('<h1>Použitá zľava</h1>');
echo('<strong>Najlepsie je vyuzit: ');

// ked je isic, nie je zlava
$typ_zlavy = zvolenieZlavy($pocetHracov, $zlava, $isic, $vyska_zlavy);

echo('<strong>Zlava je '. $vyska_zlavy.'<br>');
if($typ_zlavy == ISIC)
{
    //echo $vysledok."<br>" . "najlepsie je vyuzit isic zlavu";
    echo "isic zlavu 4 eur"; 
} 
if($typ_zlavy == PERC_10){
    echo "10 % zlavu"; 
}
if($typ_zlavy == PERC_20){     
    echo "20 % zlavu"; 
}
echo("</strong><br>");


zvolenieZlavy($pocetHracov, false, false, $ziadna_zlava /* vytvorit ti to vo funckii, prepise sa*/);
zvolenieZlavy($pocetHracov, false, true, $isic_zlava /* vytvorit ti to vo funckii, prepise sa*/);
zvolenieZlavy($pocetHracov, 20, false, $perc20_zlava /* vytvorit ti to vo funckii, prepise sa*/);
zvolenieZlavy($pocetHracov, 10, false, $perc10_zlava /* vytvorit ti to vo funckii, prepise sa*/);
echo('<h2></h2><table>');
echo("<tr><td>BEZ ZLAVY</td><td>$ziadna_zlava</td></tr>");
echo("<tr><td>ISIC</td><td>$isic_zlava</td></tr>");
echo("<tr><td>20%</td><td>$perc20_zlava</td></tr>");
echo("<tr><td>10%</td><td>$perc10_zlava</td></tr>");
echo('</table>');


if($suma){
    echo "zakaznik vyuzil darcekovu poukazku v hodnote $suma eur";
}

// Bussiness logic
function zvolenieZlavy($pocetHracov, $zlava, $isic, &$vyska_zlavy, $pocet_deti = 0 /*Nepovinny parameter musi byt vzdy na konci*/)
{
    // ked je isic, nie je zlava
    /*if($isic)
    {
        return ISIC;
    } 
    elseif($zlava == 10){
         return PERC_10;
    }
    elseif($zlava == 20){     
         return PERC_20;
    } */   

    $typ_zlavy = BEZ_ZLAVY;
    $platba_plna_suma = $pocetHracov * 19;

    $platba_s_isic = $platba_plna_suma - 4;
    $platba_s_20 = $platba_plna_suma * 0.8;
    $platba_s_10 = $platba_plna_suma * 0.9;

    // Zistime ktore je MIN
    $min = 5000;
    if($isic)
    {
        if($platba_s_isic < $min) // 15
        {
            $min = $platba_s_isic;
            $typ_zlavy = ISIC;
        }
    }
    if($zlava)
    {
        if($zlava == 20)
        {
            if($platba_s_20 < $min) // 16
            {
                $min = $platba_s_20;
                $typ_zlavy = PERC_20;
            }
        }
        if($zlava == 10)
        {
            if($platba_s_10 < $min) // 17
            {
                $min = $platba_s_10;
                $typ_zlavy = PERC_10;
            }
        }
    }
    $platba_po_zlave = $min;
    // END OF MIN SECTION

   
    if($typ_zlavy == BEZ_ZLAVY)
    {
        $vyska_zlavy = 0;
    }
    else
    {
        $vyska_zlavy = $platba_plna_suma - $platba_po_zlave;
    }

    // vypiseme MAX
    return $typ_zlavy;
}




function vypocetZlavy($vysledok, $typ_zlavy)
{
    switch ($typ_zlavy) 
    {
        case ISIC:
            return $vysledok -= 4;
            break;

        case PERC_10:
            return $vysledok *= 0.9;
            break;
        
        case PERC_20:
            return $vysledok *= 0.8;
            break;

        default:
            return $vysledok;
            break;
    }

    return $vysledok;
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

    $vyska_zlavy = 0;
    $typ_zlavy = zvolenieZlavy($pocetHracov, $zlava, $isic, $vyska_zlavy);
    $vysledok = vypocetZlavy($vysledok, $typ_zlavy);

    
    if($suma > $vysledok){
        return "darcekovy poukaz nesmie byt vacsi ako celkova cena"; // ERROR
    }
    
   

    // odpocitame sumu poukaz
    $vysledok -= $suma;

    return $vysledok; // cislo
}

?>
