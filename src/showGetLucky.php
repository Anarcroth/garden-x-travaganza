<?php
require "pdo.php";
require "catalogue.php";

session_start();

$cat = new catalogue($pdo);
$randItems = $cat->getRandomItems();

// Make the received random items in a unique array
// and also reduce the price at the same time
if (!isset($_SESSION['allItems'])) {
    $_SESSION['allItems'] = array();
    foreach ($randItems as $item) {
        if (!in_array($item['item'], $_SESSION['allItems'])) {
            $randPromoAmount = mt_rand(5, 20);
            $item['price'] -= $item['price'] * $randPromoAmount / 100;
            $_SESSION['allItems'][] = $item;
        }
    }
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['buy'])) {
    $_SESSION['luckyCart'][] = [$_GET['buy'] => $_GET['price']];
    header('location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<html>

    <title>Index</title>
    <meta charset="UTF-8" name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
    <link rel="stylesheet" type="text/css" href="cartstyle.php">

<body>
<div class="table-title">
          <h3>Your shopping cart contains <?php echo count($_SESSION['cart']) + count($_SESSION['luckyCart']); ?> items.</h3>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Items</th>
<th class="text-left">Price</th>
<th class="text-left">Description</th>
<th class="text-left">Image</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
foreach ($_SESSION['allItems'] as $i) {
    echo '<tr>';
    echo '<td class="text-left">' . $i['item'] . '<br><br><a href="' . $_SERVER['PHP_SELF'] .'?buy=' . $i['item'] . '&price=' . $i['price'] . '">Buy</a></td>';
    echo '<td class="text-left">$' . $i['price'] . '</td>';
    echo '<td class="text-left">' . $i['description'] . '</td>';
    echo '<td class="text-left"><img src="' . $i['imgpath'] . '" width="100" height="100"></img></td>';
    echo '</tr>';
}
?>
</table>
</tbody>

<?php
echo "Click here to ";
?>
<a href='showCart.php'>see items in cart</a>

</body>
</html>
