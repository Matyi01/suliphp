<?php

function osszead($szamok){
    // osszead/1/2/3/4/qwe/12
    // ["osszead","1","2","3","4","qwe","12"]
    // ami kell: [1,2,3,4,12]
    $szamok = szamKeres($szamok);
    



}

function szamKeres($szamok){
    $vissza = [];
    foreach ($szamok as $szam) {
        if (is_numeric($szam)) {
            $vissza[] = $szam;
        }
    }
    return $vissza;
}

?>