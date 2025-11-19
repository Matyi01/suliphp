<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS myDB2";
if (mysqli_query($conn, $sql)) {
}

mysqli_select_db($conn, "mydb2");


//$query = "INSERT INTO `adatok` (`adat1`, `adat2`, `adat3`, `adat4`) VALUES ('12', 'valami szöveg', '2025-11-14', 'másik szöveg');";

$query = "SELECT nev, eletkor FROM adatok";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while ($row = mysqli_fetch_assoc($result)) {
		echo "Név: " . $row["nev"] . " - életkor: " . $row["eletkor"] . "<br>";
	}
} else {
	echo "0 results";
}

//mysqli_query($conn, $query);



mysqli_close($conn);


?>