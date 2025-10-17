<?php
//text.txt

$myfile = fopen("text.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("text.txt"));
echo "<br>";
echo fgets($myfile);
fclose($myfile);

?>