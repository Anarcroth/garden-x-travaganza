<?php
require "redirect.php";

session_start();

// TODO make redirection it's own file
if (!$_SESSION['authenticated']) {
    clean_redirect("login.html");
}
?>

<html>

  <head>
    <title>Index</title>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="indexstyle.php">
  </head>

<body>

<div class="container">
  <a class="btn btn-1" href="showCatalogue.php">catalogue</a>
  <a class="btn btn-2" href="showGetLucky.php">get lucky</a>
  <a class="btn btn-3" href="showPromo.php">promo</a>
</div>

</body>
</html>
