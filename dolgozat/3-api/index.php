<?php
mysqli_report(MYSQLI_REPORT_OFF);


$file = fopen("tancrend.txt", "r");

$adatokTomb = [];
$tempTomb = [];

while (!feof($file)) {
    $sor = trim(fgets($file));
    $tempTomb[] = $sor;

    if (count($tempTomb) == 3) {
        $adatokTomb[] = [
            "tanc" => $tempTomb[0],
            "lany" => $tempTomb[1],
            "fiu" => $tempTomb[2],
        ];
        $tempTomb = [];
    }
}

fclose($file);

if (isset($_GET["path"])) {

    $apiParts = explode("/", $_GET["path"]);

    if ($apiParts[0] == "feladat") {

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($apiParts[1])) {
                if ($apiParts[1] == "emberek") {
                    //emberek neveinek lekérése
                    $fiuk = [];
                    $lanyok = [];
                    foreach ($adatokTomb as $e) {
                        if (!in_array($e["fiu"], $fiuk)) {
                            $fiuk[] = $e["fiu"];
                        }
                        if (!in_array($e["lany"], $lanyok)) {
                            $lanyok[] = $e["lany"];
                        }
                    }

                    $jsonTomb = [];
                    $jsonTomb["fiuk"] = $fiuk;
                    $jsonTomb["lanyok"] = $lanyok;
                    echo json_encode($jsonTomb);
                } elseif ($apiParts[1] == "tancok") {
                    //táncok neveinek lekérése
                    $tancok = [];
                    foreach ($adatokTomb as $e) {
                        if (!in_array($e["tanc"], $tancok)) {
                            $tancok[] = $e["tanc"];
                        }
                    }

                    $jsonTomb = [];
                    $jsonTomb["tancok"] = $tancok;
                    echo json_encode($jsonTomb);
                }
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($apiParts[1])) {
                if ($apiParts[1] == 2) {
                    //2. feladat

                    $jsonTomb = [];
                    $jsonTomb["eredmeny"] = "Elsőként bemutatott tánc: " . $adatokTomb[0]["tanc"] .
                        " Utolsóként bemutatott tánc: " . $adatokTomb[count($adatokTomb) - 1]["tanc"];
                    echo json_encode($jsonTomb);

                } elseif ($apiParts[1] == 3) {
                    //3. feladat

                    $input = json_decode(file_get_contents("php://input"), true);

                    $db = 0;

                    foreach ($adatokTomb as $e) {
                        if ($e["tanc"] == $input["tanc"]) {
                            $db++;
                        }
                    }

                    $jsonTomb = [];
                    $jsonTomb["eredmeny"] = $input["tanc"] . " táncot " . $db . " pár táncolta";
                    echo json_encode($jsonTomb);

                } elseif ($apiParts[1] == 4) {
                    //4. feladat

                    $input = json_decode(file_get_contents("php://input"), true);

                    $db = 0;

                    foreach ($adatokTomb as $e) {
                        if ($e["lany"] == $input["ember"] || $e["fiu"] == $input["ember"]) {
                            $db++;
                        }
                    }

                    $jsonTomb = [];
                    $jsonTomb["eredmeny"] = $input["ember"] . " " . $db . " táncot táncolt";
                    echo json_encode($jsonTomb);
                } elseif ($apiParts[1] == 5) {
                    //5. feladat

                    $input = json_decode(file_get_contents("php://input"), true);

                    foreach ($adatokTomb as $e) {
                        if ($e["tanc"] == $input["tanc"] && ($e["lany"] == $input["ember"] || $e["fiu"] == $input["ember"])) {
                            $par = "";
                            if ($e["lany"] == $input["ember"]) {
                                $par = $e["fiu"];
                            } else {
                                $par = $e["lany"];
                            }

                            $jsonTomb = [];
                            if ($par == "") {
                                $jsonTomb["eredmeny"] = $input["ember"] . " nem táncolt " . $input["tanc"] . "-t.";
                            } else {
                                $jsonTomb["eredmeny"] = "A " . $input["tanc"] . " bemutatóján " . $input["ember"] . " párja " . $par . " volt.";
                            }
                            echo json_encode($jsonTomb);
                            return;
                        }
                    }
                } elseif ($apiParts[1] == 6) {
                    //6. feladat
                    //Írja ki a képernyőre, hogy melyik fiú szerepelt a legtöbbször a fiúk közül, és melyik lány a lányok közül!
                    //Ha több fiú, vagy több lány is megfelel a feltételeknek, akkor valamennyi fiú, illetve valamennyi lány nevét írja ki!

                    $input = json_decode(file_get_contents("php://input"), true);

                    $fiukSzamlalo = [];
                    $lanyokSzamlalo = [];
                    foreach ($adatokTomb as $e) {
                        if (!isset($fiukSzamlalo[$e["fiu"]])) {
                            $fiukSzamlalo[$e["fiu"]] = 0;
                        }
                        $fiukSzamlalo[$e["fiu"]]++;
                        if (!isset($lanyokSzamlalo[$e["lany"]])) {
                            $lanyokSzamlalo[$e["lany"]] = 0;
                        }
                        $lanyokSzamlalo[$e["lany"]]++;
                    }
                    $maxFiuk = max($fiukSzamlalo);
                    $maxLanyok = max($lanyokSzamlalo);
                    $leggyakoribbFiuk = [];
                    $leggyakoribbLanyok = [];
                    foreach ($fiukSzamlalo as $nev => $db) {
                        if ($db == $maxFiuk) {
                            $leggyakoribbFiuk[] = $nev;
                        }
                    }
                    foreach ($lanyokSzamlalo as $nev => $db) {
                        if ($db == $maxLanyok) {
                            $leggyakoribbLanyok[] = $nev;
                        }
                    }
                    $jsonTomb = [];
                    $jsonTomb["eredmeny"] = "Legtöbbször táncoló fiúk: " . implode(", ", $leggyakoribbFiuk) .
                        " Legtöbbször táncoló lányok: " . implode(", ", $leggyakoribbLanyok);
                    echo json_encode($jsonTomb);
                }
            }
        }
    }

} else {

    ?>

    <h3>API Help</h3>





    <?php
}
?>