<?php

$host = 'localhost';
$user = 'tom';
$password = 'tom';
$db = "desezki";

$conn = mysqli_connect($host, $user, $password) or die("Povezava ni uspela!");


mysqli_select_db($conn,$db) or die("<br> povezava na bazo ni uspela.");

