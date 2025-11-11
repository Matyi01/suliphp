<!--
-file feltöltése
	-ha jpeg vagy png akkor töltse fel a képek mappába két átméretezett formában
		-nagy és kicsi
		-nagy: 800 x 600
		-kicsi: 100 széles
		-név sorszamozott, nem eredeti
		-kis képek jelenjenek meg, kattintásra a nagy
	-ha nem kép, kiterjesztése nem lehet: php, html, js
		-dokumentációk mappába másolja be, ha megfelel ennek
-->

<?php

$target_dir = "kepek/";

$config["kepek"]["kicsi"]["dir"] = $target_dir . "kicsi/";
$config["kepek"]["kicsi"]["width"] = 100;
$config["kepek"]["kicsi"]["height"] = 100;

$config["kepek"]["nagy"]["dir"] = $target_dir . "nagy/";
$config["kepek"]["nagy"]["width"] = 800;
$config["kepek"]["nagy"]["height"] = 600;


$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


$isImage = false;

if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check !== false) {
		$uploadOk = 1;
	} else {
		$uploadOk = 0;
	}
}

//https://www.w3schools.com/php/php_file_upload.asp

// Check file size
if ($_FILES["fileToUpload"]["size"] > 1048576) {
	$uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
	$isImage = true;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		//https://stackoverflow.com/questions/18805497/php-resize-image-on-upload

		/*
		$file_name = $_FILES['myFile']['tmp_name'];

		$meret = getimagesize($target_file);

		if ($meret[0] > $meret[1]) {
			$ujX = $config["kepek"]["nagy"]["width"];
			$ujY = round(($config["kepek"]["nagy"]["width"] / $meret[0]) * $meret[1]);
		} else {
			$ujY = $config["kepek"]["nagy"]["height"];
			$ujX = round(($config["kepek"]["nagy"]["height"] / $meret[1]) * $meret[0]);
		}

		$celKep = $config["kepek"]["nagy"]["dir"] . basename($_FILES["fileToUpload"]["name"]);

		$nagy = imagecreatetruecolor($ujX, $ujY);

		$forras = imagecreatefromstring(file_get_contents($file_name));

		imagecopyresampled($nagy, $forras, 0, 0, 0, 0, $ujX, $ujY, $meret[0], $meret[1]);

		imagejpeg($nagy, $celKep);
*/



	} else {
	}
}


/*
if ($uploadOk == 0) {
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		foreach ($config["kepek"] as $elem) {
			$meret = getimagesize($target_file);
			if ($elem["width"] == 0 && $elem["height"] == 0) {
				$ujX = $meret[0];
				$ujY = $meret[1];
			} elseif ($meret[0] > $meret[1]) {
				$ujX = $elem["width"];
				$ujY = round(($elem["width"] / $meret[0]) * $meret[1]);
			} else {
				$ujY = $elem["height"];
				$ujX = round(($elem["height"] / $meret[1]) * $meret[0]);
			}
			$celKep = $elem["dir"] . basename($_FILES["fileToUpload"]["name"]);
			$kicsi = imagecreatetruecolor($ujX, $ujY);
			$forras = imagecreatefromstring(file_get_contents($target_file));
			imagecopyresampled($kicsi, $forras, 0, 0, 0, 0, $ujX, $ujY, $meret[0], $meret[1]);
			imagejpeg($kicsi, $celKep);
		}
	} else {
	}
}
*/


?>

<!DOCTYPE html>
<html lang="hu">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP file upload</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
		crossorigin="anonymous"></script>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-12 bg-light p-2 text-center rounded-3 mt-3 mb-3">
				<h1>Fájl feltöltés</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
					<p>Válassz ki egy fájlt feltöltésre:</p>
					<input type="file" name="fileToUpload" id="fileToUpload" class="form-control w-25 m-3">
					<input type="submit" value="Fájl feltöltése" name="submit" class="btn btn-light border m-3">
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-12">

				<!-- https://gist.github.com/projectxcappe/1220777/9ec6a7e62fb9d7c9a93bd834fb434d7ae25ed6f5 -->

				<?php
				$files = glob("kepek/*.*");
				for ($i = 1; $i < count($files); $i++) {
					$num = $files[$i];
					echo '<img src="' . $num . '" alt="random image">' . "&nbsp;&nbsp;";
				}
				?>
			</div>
		</div>
	</div>


</body>

</html>