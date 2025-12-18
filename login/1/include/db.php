<?php

require_once("config.php");

$conn = mysqli_connect($config["db"]["host"],
                        $config["db"]["user"],
                        $config["db"]["password"],
                        $config["db"]["database"])
                        or die ("Connection failed: " . mysqli_connect_error());




?>