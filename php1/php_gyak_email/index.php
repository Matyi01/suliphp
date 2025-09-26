<?php

session_start();

if (!isset($_SESSION["email"])) {
    $_SESSION["email"] = array();
}

$lista = array();

if (isset($_GET["email"])) {
    array_push($_SESSION["email"], $_GET["email"]);
    $vag = explode("@", $_GET["email"]);
    array_push($lista, $vag[1]);
}




?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php gyak email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 container"></div>
            <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                <div class="row">
                    <div class="col-3">
                        <label for="email" class="form-label">Kérek egy emailt: </label>
                    </div>
                    <div class="col-7">
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Beküld">
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 container">
                <ul>
                    <?php
                    print_r(array_count_values($lista));
                    foreach (array_count_values($lista) as $key => $value) {
                        echo '<li class="">' . $key . " : " . $value . '</li>';
                    }
                    ?>
                </ul>

            </div>
        </div>
    </div>
</body>

</html>