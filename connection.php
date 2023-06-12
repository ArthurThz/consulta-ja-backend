<?php

$host = "localhost";
$user = "root";
$pass = "admin";
$dbname = "consultaja";
$port = "3306";


$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
