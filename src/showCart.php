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

    <title>Index</title>
    <meta charset="UTF-8" name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
    <link rel="stylesheet" type="text/css" href="cartstyle.php">

<body>
<div class="table-title">
<h3>Cart</h3>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Items in Shopping Cart</th>
<th class="text-left">Amount</th>
<th class="text-left">Price</th>
</tr>
</thead>
<tbody class="table-hover">
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
            $temp[$item] = 1;
        } else {
            $temp[$item] += 1;
        }
    }
}

// Make the lucky items unique array so that there are no duplicates in the table
$temp2 = array();
foreach ($_SESSION['luckyCart'] as $lc) {
    foreach ($lc as $item => $price) {
        if (!in_array($item, $temp2)) {
            $temp2[$item] = $price;
        }
    }
}

foreach ($temp2 as $item => $price) {
    $allItems[] = [$temp[$item] => ['item' => $item, 'price' => $price]];
}

$totalCost = 0.00;

// Loop over items in shopping cart
foreach ($allItems as $itemSet) {
    foreach ($itemSet as $itemCount => $it) {

        echo '<tr>';
        echo '<td class="text-left">' . $it['item'] . '</td>';
        echo '<td class="text-left">' . $itemCount . '</td>';
        echo '<td class="text-left">$' . $it['price'] . '</td>';
        echo '</tr>';

        $totalCost += ($it['price'] * $itemCount);
    }
}
?>
<thead>
<tr>
<th class="text-left">Promo Items</th>
<th class="text-left">Amount</th>
<th class="text-left">Price</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
// Show special free items from promo codes
foreach ($_SESSION['promoCart'] as $item => $free) {
    echo '<tr>';
    echo '<td class="text-left">' . $item . '</td>';
    echo '<td class="text-left">' . 1 . '</td>';
    echo '<td class="text-left">' . $free . '</td>';
    echo '</tr>';
}
?>
</table>
</tbody>

<div class="table-title">
<h3> <?php echo 'Total cost of items bought= ' . $totalCost; ?> </h3>
</div>

<p><a href="showCatalogue.php">Continue Shopping</a> or <a href="<?php echo $_SERVER['PHP_SELF']; ?>?checkout='true'">Check Out</a></p>
</body>
</html>
