<?php
session_start();

if (!isset($_SESSION["szo1"])) {
    $_SESSION["szo1"] = array();
} 
if (!isset($_SESSION["szo2"])) {
    $_SESSION["szo2"] = array();
} 

if (isset($_GET["szo1"])) {
    $_SESSION["szo1"][] = $_GET["szo1"];
}

if(isset($_GET["szo2"])){
    $_SESSION["szo2"][] = $_GET["szo2"];
}

$lista1 = "";

for ($i = 0; $i < sizeof($_SESSION["szo1"]); $i++) {
    $lista1 .= '<li class="">' . $_SESSION['szo1'][$i] . '</li>';
}

$lista2 = "";
for ($i = 0; $i < sizeof($_SESSION["szo2"]); $i++) {
    $lista2 .= '<li class="">' . $_SESSION['szo2'][$i] . '</li>';
}

?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gyakorlás</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 container">
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="row">
                        <div class="col-3">
                            <label for="szo1" class="form-label">Kérek egy szót: </label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="szo1" class="form-control">
                        </div>
                        <div class="col-2">
                            <input type="submit" value="Beküld">
                        </div>
                    </div>
                </form>
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="row">
                        <div class="col-3">
                            <label for="szo2" class="form-label">Kérek egy szót: </label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="szo2" class="form-control">
                        </div>
                        <div class="col-2">
                            <input type="submit" value="Beküld">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <ul>
                    <?php echo $lista1; ?>
                </ul>
            </div>
            <div class="col-12 col-lg-6">
                <ol>
                    <?php echo $lista2; ?>
                </ol>
            </div>
        </div>
    </div>
</body>

</html>