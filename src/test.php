<?php

    session_start();
    //session_destroy();
    //header("Location: prijava.php");

$t = $_SESSION['t'];
$ch = curl_init ();
curl_setopt ($ch, CURLOPT_HTTPHEADER, array ('Authorization: Bearer '.$t,
    'Conent-type: application/json'));
curl_setopt ($ch, CURLOPT_URL, 'https://graph.microsoft.com/v1.0/me/photo');
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
$rez = json_decode (curl_exec ($ch), 1);

var_dump($rez);