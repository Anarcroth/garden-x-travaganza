<?php
require "pdo.php";
require "client.php";

session_start();

$userName;
$userPass;
if (isset($_POST['userName']) && isset($_POST['passwd'])) {
    $userName = $_POST['userName'];
    $_SESSION['userName']= $userName;

    $userPass = $_POST['passwd'];
    $_SESSION['passwd'] = $userPass;
} else {
    echo "<br> Username or Password were not set!";
}

$cli = new client($pdo);
$user = $cli->get($userName);

// Checks that the user password is a valid hash of the saved passwrd in the DB
$authenticated = false;
if(password_verify($userPass, $user['password'])) {
    $authenticated = true;
}

echo $authenticated;

function redirect($url) {
    header('Location: '.$url);
    exit();
}
?>
