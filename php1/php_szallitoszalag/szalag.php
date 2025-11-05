<?php
include_once "utils.php";

function feladat2()
{
    $vissza = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get'>";
    $vissza .= "<label for='szallitasid'>Adja meg melyik adatokra kíváncsi:</label>";
    $vissza .= "<input type='number' name='szallitasid' id='szallitasid' >";
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

if (isset($_GET['szallitasid'])) {
    if ($_GET["szallitasid"] == "") {
        $szid = -1;
    }
    else {
        $szid = $_GET['szallitasid'] - 1;
    }
    if (isset ($adatok[$szid])) {
    echo "<div>Honnan: <strong>" . $adatok[$szid][1] . "</strong></div>
    <div>Hova: <strong>" . $adatok[$szid][2] . "</strong></div>";
    }
    else {
        echo "<div>Nincs ".($szid+1)." azonosítójú szállítás!</div>";
    }
}

echo feladat2();

?>