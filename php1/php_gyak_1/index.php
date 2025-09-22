<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gyakorlás</title>
</head>

<body>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        Kérek egy szöveget: <input type="text" name="szoveg" value="<?php echo $_POST["szoveg"]; ?>">
        <input type="submit">
    </form>

    <?php
    session_start();
    function kiir($szoveg)
    {
        return "<li>" . $szoveg . "</li>";
    }

    echo kiir($_POST["szoveg"]);

/*
    print_r($_SESSION);

    $_SESSION[count($_SESSION) + 1] = $_POST["szoveg"];
    print_r($_SESSION);
*/

    ?>


</body>

</html>