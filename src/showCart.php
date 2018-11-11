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

$totalCost = 0.00;

// Loop over items in shopping cart
foreach ($allItems as $itemSet) {
    foreach ($itemSet as $itemCount => $it) {

        echo '<tr>';
        echo '<td>' . $it['item'] . '</td>';
        echo '<td>' . $itemCount . '</td>';
        echo '<td>' . $it['price'] . '</td>';
        echo '</tr>';

        $totalCost += ($it['price'] * $itemCount);
    }
}
echo '</table>';

echo 'Total items bought= ' . count($_SESSION['cart']) . '<br />';
echo 'Total cost of items bought= ' . $totalCost;

?>
<pre>
<?php
//print_r($cartSet);
?>
</pre>

<p><a href="showCatalogue.php">Continue Shopping</a> or <a href="<?php echo $_SERVER['PHP_SELF']; ?>?checkout='true'">Check Out</a></p>
                                                                                                                                </body>
                                                                                                                                      </html>
