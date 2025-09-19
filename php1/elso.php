<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ez egy cim</h1>

    <?php
    
    echo "hello world";

    $alma = "<br><b><i>piros";
    $db = 5;

    echo $alma;

    $alma = $alma . "valami";
    echo $alma;

    $alma = 1;
    echo $alma;

    echo $alma++;

    echo ++$alma;

    echo "<br> szám: $alma";
    echo '<br> szám: $alma';

    echo "<pre>";
    var_dump($alma);
    echo "</pre>";

    $alma = "szovag";

    echo "<pre>";
    var_dump($alma);
    echo "</pre>";

    $alma = 3.14;

    echo "<pre>";
    var_dump($alma);
    echo "</pre>";

    
    $alma = true;

    echo "<pre>";
    var_dump($alma);
    echo "</pre>";

    for($i = 0; $i < 10; $i++)
    {
        echo $i."<br>";
    }
    $i = 0;
    while($i < 20)
    {
        echo $i++.", ";
    }
    echo "<br>";

    if($i == 20)
    {
        echo "husz<br>";
    }
    else
    {
        echo "nem husz<br>";
    }

    $tomb = ["qwe", "asd", 1, [1, 4, 12]];
    echo "<pre>";
    var_dump($tomb);
    echo "</pre>";

    $tomb[4] = 1234;
    echo "<pre>";
    var_dump($tomb);
    echo "</pre>";

    $tomb[10] = 567;
    echo "<pre>";
    var_dump($tomb);
    echo "</pre>";

    $tomb["asd"] = "ez valami";
    echo "<pre>";
    var_dump($tomb);
    echo "</pre>";














    
?>
</body>
</html>