<?php
session_start();

// TODO make redirection it's own file
if (!$_SESSION['authenticated']) {
    ob_clean();
    header('Location: login.html');
    exit();
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
