<?php
require "pdo.php";
require "catalogue.php";

session_start();

if (isset($_GET['checkout'])) {
	session_unset();
	session_destroy();
	// header('location: ' . $_SERVER['PHP_SELF']);
	exit();
}
?>

<html>
<body>

<table border="1">
             <thead> <tr> <th>Items in Shopping Cart</th> <th>Amount</th> <th>Price</th> </tr>

<?php
// Get normal cart items
$cat = new catalogue($pdo);
$cartSet = $cat->getSetOf($_SESSION['cart']);
$itemsCount = array_count_values($_SESSION['cart']);
$allItems = array();
foreach ($cartSet as $cs) {
    foreach ($itemsCount as $i => $c) {
        if ($cs['item'] == $i) {
            $allItems[] = [$c => $cs];
        }
    }
}

// Get lucky cart items
$temp = array();
$luckyItemsCount = array();
$luckyItems = array();
foreach ($_SESSION['luckyCart'] as $lc) {
    foreach ($lc as $item => $price) {
        if (!in_array($item, $temp)) {
            $temp[] = $item;
            $temp[$item] = 0;
        } else {
            $temp[$item] += 1;
        }
    }
}

foreach ($_SESSION['luckyCart'] as $lc) {
    foreach ($lc as $item => $price) {
        $allItems[] = [$temp[$item] => ['item' => $item, 'price' => $price]];
    }
}

$totalCost = 0.00;

// Loop over items in shopping cart
foreach ($allItems as $itemSet) {
    foreach ($itemSet as $itemCount => $it) {

        echo '<tr>';
        echo '<td>' . $it['item'] . '</td>';
        echo '<td>' . $itemCount . '</td>';
        echo '<td>$' . $it['price'] . '</td>';
        echo '</tr>';

        $totalCost += ($it['price'] * $itemCount);
    }
}
echo '</table>';
echo '<br><br>';
?>

<table border="1">
             <thead> <tr> <th>Promo Items</th> <th>Price</th> </tr>
<?php
// Show special free items from promo codes
foreach ($_SESSION['promoCart'] as $item => $free) {
    echo '<tr>';
    echo '<td>' . $item . '</td>';
    echo '<td>' . $free . '</td>';
    echo '</tr>';
}
echo '</table>';
echo 'Total cost of items bought= ' . $totalCost;
?>

<p><a href="showCatalogue.php">Continue Shopping</a> or <a href="<?php echo $_SERVER['PHP_SELF']; ?>?checkout='true'">Check Out</a></p>
                                                                                                                                </body>
                                                                                                                                      </html>
