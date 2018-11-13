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
}

$cli = new client($pdo);
$user = $cli->get($newUser);

// Server side check that the new username is unique
if ($user['username'] == $newUser) {
    $_SESSION['regMesg'] = "This username is already taken!";
} else {
    $cli->add($newUser, $hashed_password);
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
                <h1>Register</h1>
            </div>

            <div class="login-form">
              <form action="" method="post">
                <div class="control-group">
                <label><?php echo $_SESSION['regMesg']; ?> </label>
                <input type="text" name="newUserName" class="login-field" value="<?php if (isset($_POST['newUserName'])) echo $_POST['newUserName']; ?>" placeholder="username" id="login-name">
                <label class="login-field-icon fui-user" for="login-name"></label>
                </div>

                <div class="control-group">
                <input type="password" name="newPasswd" class="login-field" value="" placeholder="password" id="login-pass" required>
                <label class="login-field-icon fui-lock" for="login-pass"></label>
                </div>

                <button type="submitRegister" class="btn btn-primary btn-large btn-block">Go!</button>
              </form>
            </div>
        </div>
    </div>
</body>
</html>
