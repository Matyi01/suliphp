<?php

/*
összeadás
    min 2 szám összeadása
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: adja össze mind
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        ami szám, azt adja össze, szövegeket hagyja ki
    url: osszead/2/3[/4/5/6/7]
    method:GET
kivonás
    min 2 szám kivonasa
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: vonja ki mind
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        ami szám, azt vonja ki, szövegeket hagyja ki
    url: kivon/2/3[/4/5/6/7]
    method:GET
szorzás
    min 2 szám szorzása
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: szorozza össze mind
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        legyen hiba!
    url: szoroz/2/3[/4/5/6/7]
    method:GET
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

//phpinfo(32);

include_once("lang/hu.php");

if (isset($_GET["lang"])) {
    if ($_GET["lang"] == "en") {
        include_once("lang/en.php");
    }
}

$apiParts = explode("/", $_GET["path"]);

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    switch ($apiParts[0]) {
        case "osszead":
            include_once "includes/osszead.php";
            echo osszead($apiParts);
            break;
        case "kivon":
            include_once "includes/kivon.php";
            echo kivon($apiParts);
            break;
        case "szoroz":
            include_once "includes/szoroz.php";
            echo szoroz($apiParts);
            break;
        case "oszt":
            include_once "includes/oszt.php";
            echo oszt($apiParts);
            break;
        default:
            echo sprintf($GLOBALS["lang"]["Hiba: Érvénytelen művelet! (%s)"], $apiParts[0]);
            break;
    }

} else {
    echo $GLOBALS["lang"]["Hiba, nem GET"];
}



?>