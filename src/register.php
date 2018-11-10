<?php
require "pdo.php";
require "client.php";
require "redirect.php";

session_start();

$newUser;
$hashed_password;
if (isset($_POST['newUserName']) && isset($_POST['newPasswd'])) {
    $newUser = $_POST['newUserName'];

    $hashed_password = password_hash($_POST['newPasswd'], PASSWORD_DEFAULT);
} else {
    echo "<br> Username or Password were not set!";
}

$cli = new client($pdo);
$user = $cli->get($newUser);

// Server side check that the new username is unique
if ($user != null) {
    $_SESSION['regMesg'] = "This username is already taken!";
} else {
    $cli->add($newUser, $hashed_password);
    $_SESSION['regMesg'] = "Registered!";
}

clean_redirect("login.html");
?>
