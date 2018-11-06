<?php
session_start();

$newUser;
$hashed_password;
if (isset($_POST['newUserName']) && isset($_POST['newPasswd'])) {
    $newUser = $_POST['newUserName'];
    //    $_SESSION['newUserName']= $newUser;

    $hashed_password = password_hash($_POST['newPasswd'], PASSWORD_DEFAULT);
    //    $_SESSION['newPasswd'] = $hashed_password;
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

    $selectAllQuery = "SELECT * FROM users WHERE username='".$newUser."'";
    $allUsers = $conn->query($selectAllQuery);
    $userNames = [];
    foreach ($allUsers as $u) {
        $userNames[] = $u['username'];
        echo $u['username'];
    }

    // Server side check that the new username is unique
    if (in_array($newUser, $userNames)) {
        $_SESSION['regMesg'] = "This username is already taken!";
    } else {
        $sql = "INSERT INTO users (username,password) VALUES(\"".$newUser."\",\"".$hashed_password."\");";
        $conn->exec($sql);
        $_SESSION['regMesg'] = "Registered!";
    }

    redirect("login.html");
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

function redirect($url) {
    ob_clean();
    header('Location: '.$url);
    exit();
}
?>
