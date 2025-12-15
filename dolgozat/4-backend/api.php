<?php

header("Content-Type: application/json; charset=UTF-8");
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_GET["path"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "cukraszda";

    $conn = mysqli_connect($servername, $username, $password, $db);
    mysqli_set_charset($conn, "utf8mb4");
    $apiParts = explode("/", $_GET["path"]);

    if ($apiParts[0] == "feladat") {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($apiParts[1])) {
                $feladatSzam = intval($apiParts[1]);

                switch ($feladatSzam) {
                    case 1:
                        $query = "SELECT COUNT(id) AS `Hiányzó kalória érték` FROM termek WHERE kaloria IS NULL;";
                        break;
                    case 2:
                        $query = "SELECT nev, mennyiseg FROM termek INNER JOIN kiszereles ON termek.kiszerelesId = kiszereles.id WHERE mennyiseg LIKE '%g';";
                        break;
                    case 4:
                        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : '';
                        $limitQuery = $limit ? " LIMIT $limit" : '';
                        $query = "SELECT allergen.nev, COUNT(*) AS 'termék szám' FROM allergen INNER JOIN allergeninfo ON allergeninfo.allergenId = allergen.id GROUP BY allergen.nev ORDER BY 2 DESC" . $limitQuery . ";";
                        break;
                    case 5:
                        $query = "SELECT termek.nev, termek.ar FROM termek WHERE termek.laktozmentes AND termek.tejmentes AND termek.tojasmentes AND termek.id NOT IN ( SELECT allergeninfo.termekId FROM allergeninfo );";
                        break;
                    case 6:
                        $query = "SELECT CONCAT(termek.nev, ' torta') AS `torta neve`, (termek.ar-100)*12 AS `fizetendő ár` FROM termek WHERE termek.nev LIKE 'paleo %';";
                        break;
                    default:
                        $query = null;
                }

                if ($query) {
                    $results = mysqli_query($conn, $query);
                    $jsonTomb = ["info" => "success", "data" => []];

                    while ($row = mysqli_fetch_assoc($results)) {
                        $jsonTomb["data"][] = $row;
                    }

                    echo json_encode($jsonTomb, JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode([
                        "info" => "error",
                        "message" => "Érvénytelen feladat szám vagy nem GET kérés a 3. feladat esetén."
                    ], JSON_UNESCAPED_UNICODE);
                }
            } else {
                echo json_encode(["info" => "error", "message" => "Nincs megadva feladat szám."], JSON_UNESCAPED_UNICODE);
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
            if (isset($apiParts[1])) {
                $feladatSzam = intval($apiParts[1]);

                if ($feladatSzam == 3) {
                    $input = json_decode(file_get_contents("php://input"), true);

                    if (isset($input["termekId"]) && isset($input["ujAr"])) {
                        $termekId = intval($input["termekId"]);
                        $ujAr = floatval($input["ujAr"]);

                        $query = "UPDATE termek SET ar = $ujAr WHERE id = $termekId;";
                        $results = mysqli_query($conn, $query);

                        if ($results) {
                            echo json_encode(["info" => "success", "message" => "Az ár sikeresen módosítva."], JSON_UNESCAPED_UNICODE);
                        } else {
                            echo json_encode(["info" => "error", "message" => "Hiba történt az ár módosítása során."], JSON_UNESCAPED_UNICODE);
                        }
                    } else {
                        echo json_encode(["info" => "error", "message" => "Hiányzó paraméterek: termekId és ujAr szükségesek."], JSON_UNESCAPED_UNICODE);
                    }
                } else {
                    echo json_encode(["info" => "error", "message" => "Érvénytelen feladat szám a PUT kéréshez."], JSON_UNESCAPED_UNICODE);
                }
            } else {
                echo json_encode(["info" => "error", "message" => "Nincs megadva feladat szám a PUT kéréshez."], JSON_UNESCAPED_UNICODE);
            }

        }
    }
} else {

    ?>

    <h3>API Help</h3>



    <?php
}
?>