<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <input type="text" name="szoveg" value="<?php echo $_POST["szoveg"]; ?>">
        <input type="submit">
    </form>

<?php
    function kiir($szoveg){
        return "<div>".$szoveg."</div>";
    }

    echo kiir($_POST["szoveg"]);
    //phpinfo(32);
    echo strtoupper(kiir($_POST["szoveg"]));
    echo kiir(ucfirst($_POST["szoveg"]));

    $valtakozo = "";
    for ($i = 0; $i < strlen($_POST["szoveg"]); $i++){
        if ($i % 2 == 0){
            $valtakozo = $valtakozo . strtoupper($_POST["szoveg"][$i]);
        }
        else{
            $valtakozo = $valtakozo . strtolower($_POST["szoveg"][$i]);
        }
    }
    echo kiir($valtakozo);

?>
</body>
</html>