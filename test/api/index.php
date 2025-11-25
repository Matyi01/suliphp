<?php

if (isset($_GET["path"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "todolista";

    $conn = mysqli_connect($servername, $username, $password, $db);
    $apiParts = explode("/", $_GET["path"]);
    var_dump($apiParts);


    if ($apiParts[0] == "todo") {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $query = "SELECT id, szoveg, datum, vege FROM todo";
            $results = mysqli_query($conn, $query);
            $jsonTomb = [];

            while ($row = mysqli_fetch_assoc($results)) {
                $jsonTomb[] = $row;
            }

            $json = json_encode($jsonTomb);
            echo $json;

        }
        //var_dump($_SERVER["REQUEST METHOD"])
        //phpinfo(32);
    }
} else {

    ?>

    <h3>API Help</h3>





    <?php
}
?>