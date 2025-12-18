<?php

require_once("include/db.php");

if (isset($_GET["path"])) {
    $apiParts = explode("/", $_GET["path"]);
} else {
    $apiParts = [];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    if ($apiParts[0] == "login") {

        $query = "SELECT id, password FROM users WHERE username = '" .
            mysqli_real_escape_string($conn, $data["username"]) . "'";

        $results = mysqli_query($conn, $query);

        $users = [];

        while ($row = mysqli_fetch_assoc($results)) {
            $users[] = $row;
        }

        if (sizeof($users) == 1 && password_verify($data["password"], $users[0]["password"])) {
            //tkoen generálás
            $token = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", time() + 1800); //0,5 óra múlva lejár
            //echo $token;
            //var_dump($expires);
            $query = "INSERT INTO token (userid, token, datum) VALUES (" .
                intval($users[0]["id"]) . ", '" .
                mysqli_real_escape_string($conn, $token) . "', '" .
                mysqli_real_escape_string($conn, $expires) . "')";
        } else {
            echo "nem jó";
        }

    }

}


?>