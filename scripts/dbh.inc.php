<?php

$dbServername = '????????????';
$dbUsername = '????????';
$dbPassword = '??????';
$dbName = '???????';
// Connect with your database pls 

$connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
