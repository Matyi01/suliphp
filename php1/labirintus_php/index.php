<?php
session_start();
function d($elem)
{
    echo "<pre>";
    var_dump($elem);
    echo "</pre>";
}
function tablaKeszit()
{
    global $config;
    $vissza = "";
    $vissza .= "<table>";
    for ($sor = 0; $sor < $config["sor"]; $sor++) {
        $vissza .= "<tr>";
        for ($cella = 0; $cella < $config["oszlop"]; $cella++) {
            $gombszin = "";
            if (isset($_SESSION["labirintus"][$sor][$cella]) && $_SESSION["labirintus"][$sor][$cella]) {
                $gombszin = "fal";
            }

            $vissza .= '<td><input class=" ' . $gombszin . '" type="submit" name="gomb-' . $sor . '-' . $cella . '" value=""></td>';
        }
        $vissza .= "</tr>";
    }
    $vissza .= "</table>";
    return $vissza;
}

if (isset($_GET)) {
    if (isset($_GET["new"]) && $_GET["new"] == 1) {
        $_SESSION["labirintus"] = [];
    }
    $t = array_keys($_GET);
    foreach ($t as $elem) {
        if (str_starts_with($elem, "gomb-")) {
            $darabok = explode("-", $elem);
            if (sizeof($darabok) == 3) {
                if (isset($_SESSION["labirintus"][$darabok[1]][$darabok[2]]) && $_SESSION["labirintus"][$darabok[1]][$darabok[2]]) {
                    $_SESSION["labirintus"][$darabok[1]][$darabok[2]] = false;
                } else {
                    $_SESSION["labirintus"][$darabok[1]][$darabok[2]] = true;
                }
            }
        }
    }
}

function mentettlabirintusrajzol($id)
{
    global $config;
    $vissza = "";
    $vissza .= "<form method='get' action='" . $_SERVER["PHP_SELF"] . "' id='kicsi" . $id . "'>";
    $vissza .= "<div onclick='document.getElementById('kicsi" . $id . "')'>";
    for ($sor = 0; $sor < $config["sor"]; $sor++) {
        $vissza .= "<div style='display:flex;'>";
        for ($oszlop = 0; $oszlop < $config["oszlop"]; $oszlop++) {
            $gombszin = "";
            if (isset($_SESSION["mentettlabirintusok"][$id][$sor][$oszlop]) && $_SESSION["mentettlabirintusok"][$id][$sor][$oszlop]) {
                $gombszin = "fal";
            }
            $vissza .= '<div class=" ' . $gombszin . '" style="width:10px;height:10px;border:1px solid black;"></div>';
        }
        $vissza .= "</div>";
    }
    $vissza .= "</div>";
    $vissza .= "</form>";
    return $vissza;
}

//labirintus mentése
if (isset($_GET["save"])) {
    $_SESSION["mentettlabirintusok"][$_GET["save"]] = $_SESSION["labirintus"];
}

$config["oszlop"] = 10;
$config["sor"] = 10;
$tablaKesz = tablaKeszit();
$kiskep = "";
$kiskep .= mentettlabirintusrajzol(1);
$kiskep .= mentettlabirintusrajzol(2);
$kiskep .= mentettlabirintusrajzol(3);


?>

<!DOCTYPE html>
<html lang="hu">

<head>

    <title>Labirintus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        table,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            width: 30px;
            height: 30px;
            text-align: center;
        }

        td input[type="submit"] {
            width: 100%;
            height: 100%;
        }

        .fal {
            background-color: black;
        }

        form>div {
            margin: 5px;
            display: inline-block;
        }

        body {
            margin: 20px;
        }

        table {
            margin: 10px;
        }
    </style>
</head>

<body>

    <h1>Labirintus szerkeszto</h1>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
        <?php
        echo $tablaKesz;
        ?>
        <button type="submit" name="save" value="1">Mentés</button>
        <button type="submit" name="new" value="1">Új</button>

    </form>
    <?php
    echo $kiskep;
    ?>

    <!--
    Kesziteni egy sessionnel egy labirintus
    beallithatomeretu alapbol 10 * 10 es helyseg
    ebbe lehessen kattintassal elvenni hozzaadni.
    ezt sessionban eltarolni
    majd legyen egy gomb amit ez a session megjeleniti. a nulla semmit az egyes a falat jelenti
    legyen egy mentes gomb hogy tobb labirintusunk legyen.
    majd jelenjenek meg a labirintusok alul amit utana lehet fejleszteni.
    -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>