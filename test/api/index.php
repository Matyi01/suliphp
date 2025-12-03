<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_GET["path"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "todolista";

    $conn = mysqli_connect($servername, $username, $password, $db);
    $apiParts = explode("/", $_GET["path"]);

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

        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            if (isset($input["memberid"])) {
                $query = "INSERT INTO todo (szoveg, datum) VALUES('" . mysqli_real_escape_string($conn, $input["feladat"]) . "', now())";

                $results = mysqli_query($conn, $query);

                $jsonTomb = [];
                if (!$results) {
                    $jsonTomb["status"] = "error";
                    $jsonTomb["errorMessage"] = mysqli_error($conn);
                } else {
                    $jsonTomb["status"] = "success";
                }
                echo json_encode($jsonTomb);
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {

            $input = json_decode(file_get_contents("php://input"), true);

            if (isset($input["memberid"])) {

                $query = "DELETE FROM todo WHERE id = " . $apiParts[1];

                $results = mysqli_query($conn, $query);

                $jsonTomb = [];
                if (!$results) {
                    $jsonTomb["status"] = "error";
                    $jsonTomb["errorMessage"] = mysqli_error($conn);
                } else {
                    $jsonTomb["status"] = "success";
                }
                echo json_encode($jsonTomb);
            }
        }
    }
} else {

    ?>

    <h3>API Help</h3>





    <?php
}
?>