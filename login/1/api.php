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

            $query = "INSERT INTO token (userid, token, datum) VALUES (" .
                intval($users[0]["id"]) . ", '" .
                mysqli_real_escape_string($conn, $token) . "', '" .
                mysqli_real_escape_string($conn, $expires) . "')";

            mysqli_query($conn, $query);

            $json["data"]["token"] = $token;
            $json["data"]["expires"] = $expires;
            $json["status"] = "success";

        } else {

            $json["status"] = "error";
            $json["errorMessage"] = "Hibás felhasználónév vagy jelszó!";

        }

        echo json_encode($json);

    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($apiParts[0] == "logincheck") {

        $headers = get_headers("http://localhost", true);
        var_dump($headers);



        /*
        $token = mysqli_real_escape_string($conn, $_GET["token"]);

        $query = "SELECT * FROM token WHERE token = '" . $token . "' AND datum > NOW()";

        $results = mysqli_query($conn, $query);

        $tokens = [];

        while ($row = mysqli_fetch_assoc($results)) {
            $tokens[] = $row;
        }

        if (sizeof($tokens) == 1) {
            $json["status"] = "success";
        } else {
            $json["status"] = "error";
            $json["errorMessage"] = "Érvénytelen token!";
        }

        echo json_encode($json);
        */
    }



}
?>