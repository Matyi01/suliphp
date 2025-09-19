<?php
include("fuggvenyek.php");
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feladat 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <style>
        .card {
            margin: 10px;
        }

        .container {
            background-color: powderblue;
            border-left: 10px solid teal;
            border-right: 10px solid teal;
        }

        #tartalom {
            background-color: aliceblue;
        }

        #navbar {
            background-color: floralwhite;
        }

        img {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <p class="h1"><?php echo $adatok["cim"][rand(0, sizeof($adatok["cim"]) - 1)] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $adatok["kartya"]["cim"][rand(0, sizeof($adatok["kartya"]["cim"]) - 1)] ?></h5>
                        <p class="card-text">
                            <?php echo $adatok["kartya"]["szoveg"][rand(0, sizeof($adatok["kartya"]["szoveg"]) - 1)] ?>
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $adatok["kartya"]["cim"][rand(0, sizeof($adatok["kartya"]["cim"]) - 1)] ?></h5>
                        <p class="card-text">
                            <?php echo $adatok["kartya"]["szoveg"][rand(0, sizeof($adatok["kartya"]["szoveg"]) - 1)] ?>
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $adatok["kartya"]["cim"][rand(0, sizeof($adatok["kartya"]["cim"]) - 1)] ?></h5>
                        <p class="card-text">
                            <?php echo $adatok["kartya"]["szoveg"][rand(0, sizeof($adatok["kartya"]["szoveg"]) - 1)] ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-12" id="navbar">
                        <nav class="navbar navbar-expand-lg bg-body-tertiary">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#">Navbar</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="#1"><?php echo $adatok["cim"][rand(0, sizeof($adatok["cim"]) - 1)] ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="#2"><?php echo $adatok["cim"][rand(0, sizeof($adatok["cim"]) - 1)] ?></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row" id="tartalom">
                    <div class="col-12">
                        <p class="h2">
                            <?php echo $adatok["cim"][rand(0, sizeof($adatok["cim"]) - 1)] ?>
                        </p>
                        <div id="1">
                            <p class="h5">
                                <?php echo $adatok["cim"][rand(0, sizeof($adatok["cim"]) - 1)] ?>
                            </p>
                            <p>
                                <?php echo $adatok["szoveg"][rand(0, sizeof($adatok["szoveg"]) - 1)] ?>
                                <img src="img.png" class="w-25 rounded float-start" alt="...">
                            </p>
                            <p>
                                <?php echo $adatok["szoveg"][rand(0, sizeof($adatok["szoveg"]) - 1)] ?>
                            </p>
                        </div>
                        <div" id="2">
                            <p class="h5">
                                <?php echo $adatok["cim"][rand(0, sizeof($adatok["cim"]) - 1)] ?>
                            </p>
                            <p>
                                <?php echo $adatok["szoveg"][rand(0, sizeof($adatok["szoveg"]) - 1)] ?>
                            </p>
                            <img src="img.png" class="w-25 rounded float-end" alt="...">
                            <p>
                                <?php echo $adatok["szoveg"][rand(0, sizeof($adatok["szoveg"]) - 1)] ?>
                            </p>
                            <p>
                                <?php echo $adatok["szoveg"][rand(0, sizeof($adatok["szoveg"]) - 1)] ?>
                            </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php echo $adatok["szoveg"][rand(0, sizeof($adatok["szoveg"]) - 1)] ?>
            </div>
        </div>
    </div>

</body>

</html>