<?php
require "pdo.php";
require "catalogue.php";

session_start();

$cat = new catalogue($pdo);
$randItems = $cat->getRandomItems();

// Make the received random items in a unique array
// and also reduce the price at the same time
$allItems = [];
foreach ($randItems as $item) {
    if (!in_array($item['item'], $allItems)) {
        $randPromoAmount = mt_rand(5, 20);
        $item['price'] -= $item['price'] * $randPromoAmount / 100;
        $allItems[] = $item;
    }
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
