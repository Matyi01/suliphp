<?php

require_once("include/db.php");

if (isset($_GET["path"])) {
    $apiParts = explode("/", $_GET["path"]);
} else {
    $apiParts = [];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    echo password_hash($data["password"], PASSWORD_DEFAULT);

}


?>