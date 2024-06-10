<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = "dosezki";

$conn = mysqli_connect($host, $user, $password) or die("Povezava ni uspela!");
//echo "Uspelo se je povezati na streznik";

mysqli_select_db($conn,$db) or die("<br> povezava na bazo ni uspela.");
//echo "<br>Uspelo se je povezati na databazo";
