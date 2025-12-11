<?php
include_once("szamKeres.php");
function osszead($szamok){
    // osszead/1/2/3/4/qwe/12
    // ["osszead","1","2","3","4","qwe","12"]
    // ami kell: [1,2,3,4,12]
    $csakSzamok = szamKeres($szamok);
    if (sizeof($csakSzamok) < 2) {
        return $GLOBALS["lang"]["Hiba: legalább két szám kell!"];
    }
    return array_sum($csakSzamok);
}
?>