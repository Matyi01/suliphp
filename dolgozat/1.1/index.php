<!--
Készítsetek egy weboldalt, ahol be lehet lépni felhasználónév/jelszó párossal! Legyen kilépés gomb is!
Az admin / admin legyen default, fix, törölhetetlen, programba beleégetett (mind ugyanazt jelenti)!
Ha adminként jelentkezik be valaki, akkor legyen egy felhasználó hozzáadási/törlési lehetőség. ahol új felhasználót lehet hozzáadni. 
Legyen feltüntetve a belépett usernév!
Legyen lehetőség admin jogot adni valakinek, és ő akkor ugyanúgy tudjon felhasználókat kezelni!
Az adatokat mind (kivéve az admint) sessionben tároljátok el!
Bootstrap!
Ha felhasználóként lép be, akkor köszöntse az oldal!
-->
<?php
function beker()
{
    $kiir = '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
    $kiir .= '<div class="form-group">';
    $kiir .= '<label for="ujnev">Új felhasználónév: </label>';
    $kiir .= '<input type="text" name="ujnev" class="form-control">';
    $kiir .= '</div>';
    $kiir .= '<div class="form-group">';
    $kiir .= '<label for="ujjelszo">Új jelszó: </label>';
    $kiir .= '<input type="password" name="ujjelszo" class="form-control">';
    $kiir .= '</div>';
    $kiir .= '<div class="form-group">';
    $kiir .= '<label for="admin">Admin jog: </label>';
    $kiir .= '<input type="checkbox" name="admin" class="form-check-input">';
    $kiir .= '</div>';
    $kiir .= '<div class="form-group mt-2">';
    $kiir .= '<input type="submit" value="Felhasználó hozzáadása" class="btn btn-primary">';
    $kiir .= '</div>';
    $kiir .= '</form>';
    echo $kiir;
}

session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nev"]) && isset($_POST["jelszo"])) {
        $nev = $_POST["nev"];
        $jelszo = $_POST["jelszo"];
        if ($nev === "admin" && $jelszo === "admin") {
            if (!isset($_SESSION["felhasznalok"])) {
                $_SESSION["felhasznalok"] = [];
            }
            if (isset($_POST["ujnev"]) && isset($_POST["ujjelszo"])) {
                $ujnev = $_POST["ujnev"];
                $ujjelszo = $_POST["ujjelszo"];
                $admin = isset($_POST["admin"]) ? true : false;
                array_push($_SESSION["felhasznalok"], [$ujnev, $ujjelszo, $admin]);
            }
        }
    }
}

print_r($_SESSION);

?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Dolgozat</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <div class="form-group">
                        <label for="nev">Felhasználónév: </label>
                        <input type="text" name="nev" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jelszo">jelszó: </label>
                        <input type="password" name="jelszo" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" value="Belépés" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="col-6">
                <div>
                    Belépett felhasználó:
                    <?php
                    if (isset($nev)) {
                        echo $nev;
                    }
                    ?>
                </div>
                <div>
                    <?php
                    if (isset($_POST["nev"]) && isset($_POST["jelszo"])) {
                        if ($nev === "admin" && $jelszo === "admin") {
                            beker();
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>