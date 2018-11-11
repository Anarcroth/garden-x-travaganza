<?php
require "pdo.php";
require "catalogue.php";

session_start();

// TODO send an actual email to someone who has bought something
$cat = new catalogue($pdo);
$allItems = $cat->getAll();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['buy'])) {
	$_SESSION['cart'][] = $_GET['buy'];
	header('location: ' . $_SERVER['PHP_SELF']);
	exit();
}
?>

<html>
<body>

<p>Your shopping cart contains <?php echo count($_SESSION['cart']); ?> items.</p>

<p> Click on an item to add the item to your shopping cart</p>

<?php
foreach ($_SESSION['cart'] as $z) {
    echo $z;
    echo "<br>";
}
echo '<table border="1">';
foreach ($allItems as $i) {
    echo '<tr>';
    echo '<td>' . $i['item'] . '</td>';
    echo '<td>$' . $i['price'] . '</td>';
    echo '<td>' . $i['description'] . '</td>';
    echo '<td><img src="' . $i['imgpath'] . '" width="100" height="100"></img></td>';

    // Add a buy link for each item on sale
    echo '<td><a href="' . $_SERVER['PHP_SELF'] .'?buy=' . $i['item'] . '">Buy</a></td>';

    echo '</tr>';
}
echo '</table>';

echo '<br />';

echo "Click here to ";
?>
<a href='showCart.php'>see items in cart</a>

</body>
</html>
