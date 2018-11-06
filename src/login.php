<?php
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

try {
    $servername = "127.0.0.1";
    $dbname = "garden_x_travaganza";
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $user = "martin";
    $pass = "me4kaikop4e";

    $conn = new PDO($dsn, $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $selectAllQuery = "SELECT * FROM users WHERE username='".$userName."'";
    $allUsers = $conn->query($selectAllQuery);
    foreach ($allUsers as $u) {
        $dbPass = $u['password'];
    }

    // Checks that the user password is a valid hash of the saved passwrd in the DB
    $authenticated = false;
    if(password_verify($userPass, $dbPass)) {
        $authenticated = true;
    }

    echo $authenticated;

}   catch(PDOException $e) {
    echo $selectAllQuery . "<br>" . $e->getMessage();
}
?>
