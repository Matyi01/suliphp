<?php 
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