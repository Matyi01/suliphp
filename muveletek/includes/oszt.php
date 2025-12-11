<?php
/*
osztás
    min 2 szám hányadosa
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: balról jobbra osztás
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        legyen hiba!
    ha 0: hiba: nullával való osztás
    ha az első 0:return 0
    url:oszt/2/3[/4/5/6/7]
    method:GET
*/
include_once("szamKeres.php");
function oszt($szamok)
{
    $csakSzamok = szamKeres($szamok);
    if (sizeof($csakSzamok) < 2) {
        return $GLOBALS["lang"]["Hiba: legalább két szám kell!"];
    }
    if (sizeof($szamok) - 1 != sizeof($csakSzamok)) {

        return $GLOBALS["lang"]["Hiba: szavakat nem lehet osztani!"];
    }
    if ($csakSzamok[0] == 0) {
        return 0;
    }
    if (in_array(0, $csakSzamok)) {
        return $GLOBALS["lang"]["Hiba: nullával való osztás!"];
    }
    return $csakSzamok[0] ** 2 / array_product($csakSzamok);
}
?>