<?php
$fekete = "<div class='fekete'></div>";
$feher = "<div class='feher'></div>";
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakktábla</title>
    <style>
        body {
            margin: 20px;
        }

        .fekete {
            width: 50px;
            height: 50px;
            background-color: black;
            display: inline-block;
            border: 1px solid black;
        }

        .feher {
            width: 50px;
            height: 50px;
            background-color: white;
            display: inline-block;
            border: 1px solid black;
        }

        .tabla {
            line-height: 0px;
            width: auto;
        }
    </style>
</head>

<body>
    <div class="tabla">
        <?php
        for ($i = 0; $i < 8; $i++) {
            for ($j = 0; $j < 8; $j++) {
                if (($i + $j) % 2 == 0) {
                    echo $feher;
                } else {
                    echo $fekete;
                }
            }
            echo "<br>";
        }
        ?>
    </div>
</body>

</html>