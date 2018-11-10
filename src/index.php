<?php
require "redirect.php";

session_start();

// TODO make redirection it's own file
if (!$_SESSION['authenticated']) {
    clean_redirect("login.html");
}
?>

<html>
<body>
<?php
echo '<a href="showCatalogue.php">catalogue</a>';
echo '<br>';
echo '<a href="showGetLucky.php">get lucky</a>';
echo '<br>';
echo '<a href="showPromo.php">promo</a>';
?>
</body>
</html>
