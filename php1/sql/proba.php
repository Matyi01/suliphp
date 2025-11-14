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
$sql = "CREATE DATABASE IF NOT EXISTS myDB";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_select_db($conn, "mydb");

$query = "INSERT INTO `adatok` (`adat1`, `adat2`, `adat3`, `adat4`) VALUES ('12', 'valami szöveg', '2025-11-14', 'másik szöveg');";

$query = "SELECT adat1, adat2 FROM adatok";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "adat1: " . $row["adat1"]. " - adat2: " . $row["adat2"]. "<br>";
  }
} else {
  echo "0 results";
}

//mysqli_query($conn, $query);


mysqli_close($conn);


?>