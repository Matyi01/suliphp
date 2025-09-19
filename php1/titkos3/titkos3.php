<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4. Fajta bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>Privát oldal</h1>
    <?php
    if (isset($_POST["usernev"]) && $_POST["usernev"] == "akos" && isset($_POST["jelszo"]) && $_POST["jelszo"] == "1234") {
        echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Link</a>";
    } else {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h2>Belépés</h2>
                </div>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-2">
                        <label for="usernev" class="form-label">Felhasználónév: </label>
                    </div>
                    <div class="col-2">
                        <input type="text" name="usernev" id="usernev" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="jelszo" class="form-label">Jelszó: </label>
                    </div>
                    <div class="col-2">
                        <input type="password" name="jelszo" id="jelszo" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <input type="submit" value="Belépés" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
    ?>
</body>

</html>