<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üzenőfal v1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Üzenőfal</h1>
        <div class="row">
            <div class="col-6">
                <h3>Üzenet</h3>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <div class="form-group">
                        <label for="nev" class="">Feladó neve: </label>
                        <input type="text" name="nev" class="form-control"><br>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail cím:</label>
                        <input type="email" name="email" class="form-control"><br>
                    </div>
                    <div class="form-group">
                        <label for="uzenet">Üzenet:</label>
                        <input type="text" name="uzenet" class="form-control"><br>
                    </div>
                    <input type="submit" value="Küldés" class="btn btn-primary">
                </form>
            </div>
            <div class="col-6">
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $ki = $_POST["nev"] . ", " . $_POST["email"] . ": " . $_POST["uzenet"] . " - " . date('l jS \of F Y h:i:s A');
                    echo $ki;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>