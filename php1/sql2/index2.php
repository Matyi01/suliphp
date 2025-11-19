<?php

include_once "../fugvenyek.php";
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
$sql = "CREATE DATABASE IF NOT EXISTS  myDB";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}
mysqli_select_db($conn,"myDB");

$query="INSERT INTO adatok (adat1, adat2, adat3, adat4)
   VALUES ('12', 'valami szoveg', '2025-11-12', 'megint valami');";



//mysqli_query($conn,$query);
$query="SELECT adatok.adat1,t2.adat1 as masikadat1,t2.adat4, 2*adatok.adat1 as szorzas FROM adatok";
$result = mysqli_query($conn, $query);

echo "<br>";

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    var_dump($row);
    //echo "id: " . $row["adat1"]. " - Name: " . $row["adat4"]." szorzás:".$row["szorzas"]."<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>