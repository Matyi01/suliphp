<?php
session_start();
$kiir = "";
$kiir .= $_SESSION["nev"];
$kiir .= "<br>";
$kiir .= $_SESSION["email"];
$kiir .= "<br>";
$kiir .= $_SESSION["telefon"];
$kiir .= "<br>";
$kiir .= $_SESSION["cim"];
$kiir .= "<br>";
$kiir .= $_SESSION["jelszo"];


if (isset($_POST["logout"])) {
    session_destroy();
    echo "Session törölve.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
</head>

<body>
    <?php
    echo $kiir;
    ?>
    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>

</html>