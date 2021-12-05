<?php 
// 19€ na hraca
if(isset($_POST['pocet_hracov']))
    $pocetHracov = $_POST['pocet_hracov'];

// isic -4€ skupinu (z celkovej sumy);
if(isset($_POST['isic']))
    $isic = $_POST['isic']; 

// 10% zľava (z celkovej sumy)
if(isset($_POST['zlava']))
    $zlava = $_POST['zlava']; 

// - xy €
if(isset($_POST['suma_darc_poukazu']))
    $suma = $_POST['suma_darc_poukazu'];

$vysledok = $pocetHracov * 19;

// odpocitame isic zlavu
if($isic == 'ISIC')
    $vysledok -= 4;

$vysledok -= 4;

// odpocitame 10% zlavu
if ($zlava == 10){
    $vysledok *= 0.9;
}

if ($zlava == 20){
    $vysledok *= 0.8;
}

$vysledok -= $suma;


echo($vysledok);

?>