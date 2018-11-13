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
?>

<html>

  <head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="loginstyle.php">
  </head>

  <body>
    <div class="login">
        <div class="login-screen">
            <div class="app-title">
                <h1>Login</h1>
            </div>

            <div class="login-form">
              <form action="" method="post">
                <div class="control-group">
                <input type="text" name="userName" class="login-field" value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>" placeholder="username" id="login-name">
                <label class="login-field-icon fui-user" for="login-name"></label>
                </div>

                <div class="control-group">
                <input type="password" name="passwd" class="login-field" value="" placeholder="password" id="login-pass" required>
                <label class="login-field-icon fui-lock" for="login-pass"></label>
                </div>

                <button type="submitLogin" class="btn btn-primary btn-large btn-block">login</button>
              </form>
              <a class="login-link" href="register.php">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
