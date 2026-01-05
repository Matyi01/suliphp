<?php
/*
Funkció	Példa URL	Leírás
Faktoriális	/fakt/5	5 faktoriálisa (max 20).
Szorzat	/szorzat/4/6	4 * 6 eredménye.
Háromszög	/haromszog/3/4/5	Heron-képlettel számolt terület.
Random (max)	/random/100	Szám 0 és 100 között.
Random (tól-ig)	/random/10/20	Szám 10 és 20 között.
Random (lépés)	/random/0/100/10	"0, 10, 20...100 közül egy."
Lorem Ipsum	/lorem/3	Az első 3 mondat a listából.

*/
function szamKeres($szam)
{
    $vissza = "Nem szám";
    if (is_numeric($szam)) {
        $vissza = $szam;
    }
    return $vissza;
}

$apiParts = explode("/", $_GET["path"]);


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    switch ($apiParts[0]) {
        case "fakt":
            $szam = szamKeres($apiParts[1]);
            if ($szam == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }

            if ($szam > 20) {
                echo json_encode(["eredmeny" => "Hiba: Túl nagy szám!"]);
                break;
            }

            $eredmeny = 1;
            for ($i = 1; $i <= $szam; $i++) {
                $eredmeny *= $i;
            }
            echo json_encode(["eredmeny" => $eredmeny]);
            break;
        case "szorzat":
            $szam1 = szamKeres($apiParts[1]);
            $szam2 = szamKeres($apiParts[2]);
            if ($szam1 == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }
            if ($szam2 == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }

            $eredmeny = $szam1 * $szam2;
            echo json_encode(["eredmeny" => $eredmeny]);
            break;
        case "haromszog":
            $szam1 = szamKeres($apiParts[1]);
            $szam2 = szamKeres($apiParts[2]);
            $szam3 = szamKeres($apiParts[3]);
            if ($szam1 == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }
            if ($szam2 == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }
            if ($szam3 == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }

            $szerkesztheto = false;
            if ($szam1 + $szam2 > $szam3 && $szam1 + $szam3 > $szam2 && $szam2 + $szam3 > $szam1) {
                $szerkesztheto = true;
            }
            $s = ($szam1 + $szam2 + $szam3) / 2;
            $terulet = sqrt($s * ($s - $szam1) * ($s - $szam2) * ($s - $szam3));
            $eredmeny = ["szerkesztheto" => $szerkesztheto, "terulet" => $terulet];

            echo json_encode(["eredmeny" => $eredmeny]);
            break;
        case "random":
            $szam1 = szamKeres($apiParts[1]);
            if ($szam1 == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }

            if (isset($apiParts[3]) && $apiParts[3] != "") {
                $szam2 = szamKeres($apiParts[2]);
                if ($szam2 == "Nem szám") {
                    echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                    break;
                }
                $szam3 = szamKeres($apiParts[3]);
                if ($szam3 == "Nem szám") {
                    echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                    break;
                }

                $lepesek = range($szam1, $szam2, $szam3);
                echo json_encode(["eredmeny" => $lepesek[array_rand($lepesek)]]);

                //echo json_encode(["eredmeny" => rand($szam1, $szam2 / $szam3) * $szam3]);
            } else if (isset($apiParts[2]) && $apiParts[2] != "") {
                $szam2 = szamKeres($apiParts[2]);
                if ($szam2 == "Nem szám") {
                    echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                    break;
                }

                echo json_encode(["eredmeny" => rand($szam1, $szam2)]);
            } else {
                echo json_encode(["eredmeny" => rand(0, $szam1)]);
            }
            break;
        case "lorem":
            $szam1 = szamKeres($apiParts[1]);
            if ($szam == "Nem szám") {
                echo json_encode(["eredmeny" => "Hiba: Nem szám!"]);
                break;
            }

            $lorem = [
                "Lorem ipsum dolor sit amet.",
                "Consectetur adipiscing elit.",
                "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.",
                "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.",
                "Eu fugiat nulla pariatur.",
                "Excepteur sint occaecat cupidatat non proident.",
                "Sunt in culpa qui officia deserunt mollit anim id est laborum.",
                "Curabitur pretium tincidunt lacus.",
                "Nulla gravida orci a odio.",
                "Nullam varius, turpis et commodo pharetra.",
                "Est eros bibendum elit, nec luctus magna felis sollicitudin mauris.",
                "Integer in mauris eu nibh euismod gravida.",
                "Duis ac tellus et risus vulputate vehicula.",
                "Donec lobortis risus a elit.",
                "Etiam tempor.",
                "Ut ullamcorper, ligula eu tempor congue.",
                "Eros est euismod turpis, id tincidunt sapien risus a quam.",
                "Maecenas fermentum consequat mi.",
                "Donec fermentum.",
                "Pellentesque malesuada nulla a mi.",
                "Lorem ipsum dolor sit amet.",
                "Consectetur adipiscing elit.",
                "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.",
                "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.",
                "Eu fugiat nulla pariatur.",
                "Excepteur sint occaecat cupidatat non proident.",
                "Sunt in culpa qui officia deserunt mollit anim id est laborum.",
                "Curabitur pretium tincidunt lacus.",
                "Nulla gravida orci a odio.",
                "Nullam varius, turpis et commodo pharetra.",
                "Est eros bibendum elit, nec luctus magna felis sollicitudin mauris.",
                "Integer in mauris eu nibh euismod gravida.",
                "Duis ac tellus et risus vulputate vehicula.",
                "Donec lobortis risus a elit.",
                "Etiam tempor.",
                "Ut ullamcorper, ligula eu tempor congue.",
                "Eros est euismod turpis, id tincidunt sapien risus a quam.",
                "Maecenas fermentum consequat mi.",
                "Donec fermentum.",
                "Pellentesque malesuada nulla a mi.",
                "Lorem ipsum dolor sit amet.",
                "Consectetur adipiscing elit.",
                "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.",
                "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.",
                "Eu fugiat nulla pariatur.",
                "Excepteur sint occaecat cupidatat non proident.",
                "Sunt in culpa qui officia deserunt mollit anim id est laborum.",
                "Curabitur pretium tincidunt lacus.",
                "Nulla gravida orci a odio.",
                "Nullam varius, turpis et commodo pharetra.",
                "Est eros bibendum elit, nec luctus magna felis sollicitudin mauris.",
                "Integer in mauris eu nibh euismod gravida.",
                "Duis ac tellus et risus vulputate vehicula.",
                "Donec lobortis risus a elit.",
                "Etiam tempor.",
                "Ut ullamcorper, ligula eu tempor congue.",
                "Eros est euismod turpis, id tincidunt sapien risus a quam.",
                "Maecenas fermentum consequat mi.",
                "Donec fermentum.",
                "Pellentesque malesuada nulla a mi.",
                "Lorem ipsum dolor sit amet.",
                "Consectetur adipiscing elit.",
                "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.",
                "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.",
                "Eu fugiat nulla pariatur.",
                "Excepteur sint occaecat cupidatat non proident.",
                "Sunt in culpa qui officia deserunt mollit anim id est laborum.",
                "Curabitur pretium tincidunt lacus.",
                "Nulla gravida orci a odio.",
                "Nullam varius, turpis et commodo pharetra.",
                "Est eros bibendum elit, nec luctus magna felis sollicitudin mauris.",
                "Integer in mauris eu nibh euismod gravida.",
                "Duis ac tellus et risus vulputate vehicula.",
                "Donec lobortis risus a elit.",
                "Etiam tempor.",
                "Ut ullamcorper, ligula eu tempor congue.",
                "Eros est euismod turpis, id tincidunt sapien risus a quam.",
                "Maecenas fermentum consequat mi.",
                "Donec fermentum.",
                "Pellentesque malesuada nulla a mi.",
                "Lorem ipsum dolor sit amet.",
                "Consectetur adipiscing elit.",
                "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.",
                "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.",
                "Eu fugiat nulla pariatur.",
                "Excepteur sint occaecat cupidatat non proident.",
                "Sunt in culpa qui officia deserunt mollit anim id est laborum.",
                "Curabitur pretium tincidunt lacus.",
                "Nulla gravida orci a odio.",
                "Nullam varius, turpis et commodo pharetra.",
                "Est eros bibendum elit, nec luctus magna felis sollicitudin mauris.",
                "Integer in mauris eu nibh euismod gravida.",
                "Duis ac tellus et risus vulputate vehicula.",
                "Donec lobortis risus a elit.",
                "Etiam tempor.",
                "Ut ullamcorper, ligula eu tempor congue.",
                "Eros est euismod turpis, id tincidunt sapien risus a quam.",
                "Maecenas fermentum consequat mi.",
                "Donec fermentum.",
                "Pellentesque malesuada nulla a mi.",
            ];
            $eredmeny = array_slice($lorem, 0, $szam);
            echo json_encode(["eredmeny" => $eredmeny]);
            break;
        default:
            echo "Hiba: Érvénytelen művelet! (" . $apiParts[0] . ")";
            break;
    }

}

?>