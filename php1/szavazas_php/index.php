<?php


session_start();

if (!isset($_SESSION["szavazas"])) {
    $_SESSION["szavazas"] = array();
}

if (!isset($_SESSION["ido"])) {
    $_SESSION["ido"] = time();
}


if (time() - $_SESSION["ido"] > 3) {
    if (isset($_SESSION["szavazas"][$_GET["szavazas"]])) {
        $_SESSION["szavazas"][$_GET["szavazas"]]++;
    } else if (isset($_GET["szavazas"])) {
        $_SESSION["szavazas"][$_GET["szavazas"]] = 1;
    }
}

$_SESSION["ido"] = time();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szavazás</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>">
        <label for="szavazas">Kire szavazol?</label>
        <select name="szavazas" id="szavazas">
            <option value="jelolt1">Jelölt 1</option>
            <option value="jelolt2">Jelölt 2</option>
            <option value="jelolt3">Jelölt 3</option>
            <option value="jelolt4">Jelölt 4</option>
            <option value="jelolt5">Jelölt 5</option>
        </select>
        <input type="submit" value="Szavazok">
    </form>
    <div id="eredmeny">
        <ul>
            <?php
            if ($_GET["szavazas"] == "0") {
                foreach ($_SESSION["szavazas"] as $key => $value) {
                    echo "<li>" . $key . " : " . $value . "</li>";
                }
            }
            ?>
        </ul>
        <?php
        if ($_GET["szavazas"] == "0") {
            $osszes = $_SESSION["szavazas"]["jelolt1"] + $_SESSION["szavazas"]["jelolt2"] + $_SESSION["szavazas"]["jelolt3"] + $_SESSION["szavazas"]["jelolt4"] + $_SESSION["szavazas"]["jelolt5"];

            $j1 = ($_SESSION["szavazas"]["jelolt1"] / $osszes) * 100;
            $j2 = ($_SESSION["szavazas"]["jelolt2"] / $osszes) * 100;
            $j3 = ($_SESSION["szavazas"]["jelolt3"] / $osszes) * 100;
            $j4 = ($_SESSION["szavazas"]["jelolt4"] / $osszes) * 100;
            $j5 = ($_SESSION["szavazas"]["jelolt5"] / $osszes) * 100;
            echo "Jelölt 1: " . round($j1, 2) . "%<br>";
            echo "Jelölt 2: " . round($j2, 2) . "%<br>";
            echo "Jelölt 3: " . round($j3, 2) . "%<br>";
            echo "Jelölt 4: " . round($j4, 2) . "%<br>";
            echo "Jelölt 5: " . round($j5, 2) . "%<br>";
            
        }
        ?>
    </div>
    </div>
</body>

</html>