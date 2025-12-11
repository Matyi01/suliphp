<?php
/*
kivonás
    min 2 szám kivonasa
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: vonja ki mind
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        ami szám, azt vonja ki, szövegeket hagyja ki
    url: kivon/2/3[/4/5/6/7]
    method:GET
*/
include_once("szamKeres.php");
function kivon($szamok){
    $csakSzamok = szamKeres($szamok);
    if (sizeof($csakSzamok) < 2) {
        return $GLOBALS["lang"]["Hiba: legalább két szám kell!"];
    }
    return 2 * $csakSzamok[0] - array_sum($csakSzamok);
}
?>