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

session_start();

function userkiir()
{
    $vissza = "<ul>";
    foreach ($_SESSION["users"] as $ertek) {
        $admine = "";
        if ($ertek["admin"]) {
            $admine = "Igen";
        } else {
            $admine = "Nem";
        }
        $vissza .= '<li>Felhasználónév: ' . $ertek["name"] . '<br>Jelszó: ' . $ertek["pass"] . '<br>Admin jogosultság: ' . $admine . '</li>';
    }
    $vissza .= "</ul>";
    return $vissza;
}

if (!isset($_SESSION["belepve"])) {
    $_SESSION["belepve"] = false;
}
if (!isset($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}
if (!isset($_SESSION["aktivUserId"])) {
    $_SESSION["aktivUserId"] = null;
}
if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = [
        1 => ["name" => "admin", "pass" => "admin", "admin" => true]
    ];
}
if (isset($_POST)) {
    if (isset($_POST["nev"]) && isset($_POST["jelszo"]) && $_POST["nev"] == "admin" && $_POST["jelszo"] == "admin") {
        $_SESSION["belepve"] = true;
        $_SESSION["admin"] = true;
        $_SESSION["aktivUserId"] = 1;
    } else if (isset($_POST["nev"]) && isset($_POST["jelszo"])) {
        foreach ($_SESSION["users"] as $id => $user) {
            if ($user["name"] == $_POST["nev"] && $user["pass"] == $_POST["jelszo"]) {
                $_SESSION["belepve"] = true;
                $_SESSION["admin"] = $user["admin"];
                $_SESSION["aktivUserId"] = $id;
                break;
            }
        }
    }
    if (isset($_POST["kilepes"])) {
        $_SESSION["belepve"] = false;
        $_SESSION["admin"] = false;
        $_SESSION["aktivUserId"] = null;
    }
    if (isset($_POST["ujnev"]) && isset($_POST["ujjelszo"]) && isset($_POST["admin"]) && $_SESSION["admin"]) {
        $ujnev = $_POST["ujnev"];
        $ujjelszo = $_POST["ujjelszo"];
        $admin = $_POST["admin"] ? true : false;
        $ujId = max(array_keys($_SESSION["users"])) + 1;
        $_SESSION["users"][$ujId] = ["name" => $ujnev, "pass" => $ujjelszo, "admin" => $admin];
    }
    if (isset($_POST["ujnev"]) && isset($_POST["ujjelszo"]) && !isset($_POST["admin"]) && $_SESSION["admin"]) {
        $ujnev = $_POST["ujnev"];
        $ujjelszo = $_POST["ujjelszo"];
        $admin = false;
        $ujId = max(array_keys($_SESSION["users"])) + 1;
        $_SESSION["users"][$ujId] = ["name" => $ujnev, "pass" => $ujjelszo, "admin" => $admin];
    }
    if (isset($_POST["delUser"]) && isset($_POST["id"]) && $_SESSION["admin"]) {
        $id = $_POST["id"];
        if ($id != 1 && array_key_exists($id, $_SESSION["users"])) {
            unset($_SESSION["users"][$id]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP doga</title>
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

            <?php if (!$_SESSION["belepve"]) { ?>
                <div class="col-4">
                </div>
                <div class="col-4">
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
                <div class="col-4">
                </div>
            <?php } else if ($_SESSION["belepve"] && $_SESSION["admin"]) { ?>
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <h2>Üdv, <?php echo $_SESSION["users"][$_SESSION["aktivUserId"]]["name"]; ?> nevű admin!</h2>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="mb-3">
                            <input type="hidden" name="kilepes" value="1">
                            <input type="submit" value="Kilépés" class="btn btn-danger">
                        </form>
                        <h3>Felhasználó hozzáadás</h3>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="mb-3">
                            <div class="form-group">
                                <label for="ujnev">Új felhasználónév: </label>
                                <input type="text" name="ujnev" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ujjelszo">Új jelszó: </label>
                                <input type="password" name="ujjelszo" class="form-control" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="admin" class="form-check-input" id="adminCheck">
                                <label class="form-check-label" for="adminCheck">Admin jogosultság</label>
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" value="Felhasználó hozzáadás" class="btn btn-success">
                            </div>
                        </form>

                    </div>
                    <div class="col-4">
                        <h3>Felhasználók listája</h3>
                    <?php echo userkiir(); ?>
                        <h3>Felhasználó törlés</h3>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="mb-3">
                            <div class="form-group">
                                <label for="id">Törlendő felhasználó ID: </label>
                                <input type="number" name="id" class="form-control" required>
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" name="delUser" value="Felhasználó törlése" class="btn btn-danger">
                            </div>
                        </form>
                    </div>
            <?php } else if ($_SESSION["belepve"] && !$_SESSION["admin"]) { ?>
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <h2>Üdv, <?php echo $_SESSION["users"][$_SESSION["aktivUserId"]]["name"]; ?> nevű felhasználó!
                            </h2>
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="mb-3">
                                <input type="hidden" name="kilepes" value="1">
                                <input type="submit" value="Kilépés" class="btn btn-danger">
                            </form>

                        </div>
                        <div class="col-4">
                            <h3>Felhasználók listája</h3>
                    <?php echo userkiir(); ?>
                        </div>
            <?php } ?>

        </div>

    </div>
</body>

</html>