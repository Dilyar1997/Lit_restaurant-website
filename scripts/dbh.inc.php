<?php

$dbServername = '146.50.38.152';
$dbUsername = 'PhoKingNais';
$dbPassword = '123';
$dbName = 'PhoKingNais';

$connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
