<?php
session_start();

$userName = $_POST['userName'];
$_SESSION['userName']= $username;

$userPass = $_POST['passwd'];
$_SESSION['passwd'] = $userPass;

$servername = "127.0.0.1";
$dbname = "garden_x_travaganza";
$dsn = "mysql:host=$servername;dbname=$dbname";
$user = "martin";
$pass = "me4kaikop4e";

try {
    $conn = new PDO($dsn, $user, $pass);

    $sql = 'SELECT * FROM users';

    $result = $conn->query($sql);

    $authenticated = false;
    foreach ($result as $u) {
        if ($u['username'] == $userName) {
            $authenticated = true;
        }
    }

    echo $authenticated;

}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>
