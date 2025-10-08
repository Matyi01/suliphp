<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$_SESSION["nev"] = $_POST["nev"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["telefon"] = $_POST["telefon"];
$_SESSION["cim"] = $_POST["cim"];
$_SESSION["jelszo"] = $_POST["jelszo"];
header("Location: summary.php");
exit;
}
?>