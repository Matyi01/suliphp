<?php
/*
szorzás
    min 2 szám szorzása
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: szorozza össze mind
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        legyen hiba!
    url: szoroz/2/3[/4/5/6/7]
    method:GET
*/
include_once("szamKeres.php");
function szoroz($szamok){
    $csakSzamok = szamKeres($szamok);
    if (sizeof($csakSzamok) < 2) {
        return $GLOBALS["lang"]["Hiba: legalább két szám kell!"];
    }
    if (sizeof($szamok) - 1 != sizeof($csakSzamok)) {
        
        return $GLOBALS["lang"]["Hiba: szavakat nem lehet szorozni!"];
    }
    return array_product($csakSzamok);
}