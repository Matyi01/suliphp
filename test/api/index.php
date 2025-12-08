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
            if (isset($apiParts[1])) {
                if (isset($_GET["memberid"])) {

                    $query = "SELECT id, szoveg, datum, vege FROM todo WHERE id = " . mysqli_real_escape_string($conn, $apiParts[1]);
                    $results = mysqli_query($conn, $query);

                    $jsonTomb = [];

                    if (mysqli_num_rows($results) == 0) {

                        $jsonTomb["status"] = "error";
                        $jsonTomb["errorMessage"] = "Hiba: Érvénytelen azonosító! (" . $apiParts[1] . ")";

                    } else {

                        $jsonTomb = ["status" => "success"];
                        $jsonTomb["data"] = [];

                        while ($row = mysqli_fetch_assoc($results)) {
                            $jsonTomb["data"][] = $row;
                        }
                    }


                    $json = json_encode($jsonTomb);
                    echo $json;
                }
            } else {
                $query = "SELECT id, szoveg, datum, vege FROM todo";
                $results = mysqli_query($conn, $query);
                $jsonTomb = [];

                while ($row = mysqli_fetch_assoc($results)) {
                    $jsonTomb[] = $row;
                }

                $json = json_encode($jsonTomb);
                echo $json;
            }

        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            if (isset($input["memberid"])) {
                $query = "INSERT INTO todo (szoveg, datum) VALUES('" . mysqli_real_escape_string($conn, $input["feladat"]) . "', NOW())";

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
                if ($apiParts[1] == "all") {
                    $query = "DELETE FROM todo WHERE vege IS NOT NULL";
                } else {
                    $query = "DELETE FROM todo WHERE id = " . mysqli_real_escape_string($conn, $apiParts[1]);
                }

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
        } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $input = json_decode(file_get_contents("php://input"), true);

            if (isset($input["memberid"]) && isset($apiParts[2])) {
                if ($apiParts[2] == "edit") {
                    $query = "UPDATE todo 
                    SET szoveg = '" . mysqli_real_escape_string($conn, $input["feladat"]) . "' 
                    WHERE id = " . mysqli_real_escape_string($conn, $apiParts[1]);
                } elseif ($apiParts[2] == "pipa") {
                    $query = "UPDATE todo 
                    SET vege = NOW() 
                    WHERE id = " . mysqli_real_escape_string($conn, $apiParts[1]);
                } else {
                    $query = "";
                }

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