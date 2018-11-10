<?php
require "pdo.php";
require "catalogue.php";

session_start();

$catalogue = [];
$items = [];
$ids = [];
$prices = [];
$descriptions = [];
$imgPaths = [];
$codes = [];

// TODO send an actual email to someone who has bought something
$cat = new catalogue($pdo);
$allItems = $cat->getAll();

foreach ($allItems as $i) {
    $items[] = $i['item'];
    $ids[] = $i['id'];
    $prices[] = $i['price'];
    $descriptions[] = $i['description'];
    $imgPaths[] = $i['imgpath'];
}

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
echo '<table border="1">';
for ($i = 0; $i < count($items); $i++) {
    echo '<tr>';
    echo '<td>' . $items[$i] . '</td>';
    echo '<td>$' . $prices[$i] . '</td>';
    echo '<td>' . $descriptions[$i] . '</td>';
    echo '<td><img src="' . $imgPaths[$i] . '" width="100" height="100"></img></td>';

    // Add a buy link for each item on sale
    echo '<td><a href="' . $_SERVER['PHP_SELF'] .'?buy=' . $i . '">Buy</a></td>';

    echo '</tr>';
}
echo '</table>';

echo '<br />';

echo "Click here to ";
?>
<a href='showCart.php'>see items in cart</a>

</body>
</html>
