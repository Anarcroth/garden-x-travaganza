<?php
$servername = "127.0.0.1";
$dbname = "garden_x_travaganza";
$dsn = "mysql:host=$servername;dbname=$dbname";
$user = "martin";
$pass = "me4kaikop4e";

$conn = new PDO($dsn, $user, $pass);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
