<?php

session_start();





?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-2 bg-primary"></div>
            <div class="col-12 col-lg-8 container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link"
                                href="<?php echo $_SERVER["PHP_SELF"] ?>?oldal=1">tartalom 1</a>
                            <a class="nav-item nav-link"
                                href="<?php echo $_SERVER["PHP_SELF"] ?>?oldal=2">tartalom 2</a>
                            <a class="nav-item nav-link"
                                href="<?php echo $_SERVER["PHP_SELF"] ?>?oldal=3">tartalom 3</a>
                            <a class="nav-item nav-link"
                                href="<?php echo $_SERVER["PHP_SELF"] ?>?oldal=4">tartalom 4</a>
                        </div>
                    </div>
                </nav>
                <title>asd</title>
                <?php
                if (!isset($_GET["oldal"])) {
                     $_SESSION[1] = 1;
                    include("1.php");
                } else {
                    include($_GET["oldal"] . ".php");
                    $_SESSION[$_GET["oldal"]]++;
                }
                ?>
            </div>
            <div class="col-12 col-lg-2 bg-primary"></div>
        </div>
    </div>
</body>

</html>