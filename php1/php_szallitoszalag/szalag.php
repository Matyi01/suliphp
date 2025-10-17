<?php
include_once "utils.php";

function feladat2()
{
    $vissza = "<form action='".$_SERVER['PHP_SELF']."' method='get'>";
    $vissza .= "<labal for='szallitasid' >Adja meg melyik adatokra kíváncsi:</label>";
    $vissza .= "<input type='number' name='szallitasid' id='szallitasid'>";
    $vissza .= "<input type='submit' value='Küldés'>";
    $vissza .= "</form>";
    return $vissza;
}



$myfile = fopen("szallit.txt", "r") or die("Unable to open file!");

$adatok = [];
$sor = fgets($myfile);
$darabok = explode(" ", $sor);
$szalaghossz = $darabok[0];
$sebesseg = $darabok[1];

while (!feof($myfile)) {
    $sor = fgets($myfile);
    if ($sor != "") {
        $darabok = explode(" ", $sor);
        $adatok[] = $darabok;
    }
}
fclose($myfile);

echo feladat2();

?>