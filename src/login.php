<?php
session_start();

// TODO add validation for the input
$userName = $_POST['userName'];
$_SESSION['userName']= $username;

$userPass = $_POST['passwd'];
$_SESSION['passwd'] = $userPass;


// Add your database name (i.e. username), username and password
$servername = "localhost";
$dbname = "mdn";
$dsn = "mysql:host=$servername;dbname=$dbname";
$user = "mdn";
$pass = "1234";

try {
    $conn = new PDO($dsn, $user, $pass);

    $sql = "";

    $result = $conn->exec($sql);

    $sql = 'SELECT * FROM customers';

    $result = $conn->query($sql);

    htmlTable($result);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>
