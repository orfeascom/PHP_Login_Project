<?php

// Parameters to connect to a database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "php_project_login";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName, 33306);

if (!$conn){
    die("Databae connection failed!");
}

?>