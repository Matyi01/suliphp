<?php
function mappaNev()
{
    $nev = "";
    $hossz = rand(2, 8);
    for ($i = 0; $i < $hossz; $i++) {
        $letter = chr(rand(97, 122));
        $nev .= $letter;
    }
    return $nev;
}

function mappakeszit()
{
    $mappaDb = rand(1, 5);
    $mappaNevek = [];
    
    for ($i = 0; $i < $mappaDb; $i++) {
        $mappaNevek[] = mappaNev();
    }

    var_dump($mappaNevek);

    $structure = "./";

    for ($i = 0; $i < $mappaDb; $i++) {
        $structure .= $mappaNevek[$i] . "/";
    }

    if (!mkdir($structure, 0777, true)) {
        die('Failed to create directories...');
    }
}

mappakeszit();

?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mappák</title>
</head>

<body>

</body>

</html>