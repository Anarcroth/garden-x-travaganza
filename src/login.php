<?php
require "pdo.php";
require "client.php";
require "redirect.php";

session_start();

$userName;
$userPass;
if (isset($_POST['userName']) && isset($_POST['passwd'])) {
    $userName = $_POST['userName'];
    $_SESSION['userName']= $userName;

    $userPass = $_POST['passwd'];
    $_SESSION['passwd'] = $userPass;
}

$cli = new client($pdo);
$user = $cli->get($userName);

// Checks that the user password is a valid hash of the saved passwrd in the DB
if(password_verify($userPass, $user['password'])) {
    $_SESSION['authenticated'] = true;
    redirect("index.php");
}

//redirect("login.php");
?>

<html>

  <head>
    <title>Login</title>
    <meta charset="UTF-8">
  </head>

  <body>
    <form method="post" action="">
      <div class="imgcontainer">
        <img src="img_avatar2.png" alt="Avatar" class="avatar">
      </div>

      <div class="loginForm">
        <label for="userName"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="userName">

        <label for="passwd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="passwd">

        <button type="submitLogin">Login</button>
      </div>
    </form>

    <form method="post" action="register.php">
      <div class="registrationForm">
        <label for="newUserName"><b>Username</b></label>
        <input type="text" placeholder="Enter a unique username" name="newUserName" required>

        <label for="newPasswd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="newPasswd" required>

        <button type="submitReg">Register</button>
      </div>
    </form>
  </body>
</html>
