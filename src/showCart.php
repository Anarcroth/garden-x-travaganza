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
             <thead> <tr> <th>Items in Shopping Cart</th> <th>Price</th> </tr>

<?php
$cat = new catalogue($pdo);
$allItems = $cat->getSetOf($_SESSION['cart']);

$totalItems = count($_SESSION['cart']);
$totalCost = 0.00;

// Loop over items in shopping cart
foreach ($allItems as $i) {
	echo '<tr>';
	echo '<td>' . $i['item'] . '</td>';
	echo '<td>' . $i['price'] . '</td>';
	echo '</tr>';

	$totalCost = $totalCost + $i['price'];
}
echo '</table>';

echo 'Total items bought= ' . $totalItems . '<br />';
echo 'Total cost of items bought= ' . $totalCost;

?>

<p><a href="showCatalogue.php">Continue Shopping</a> or <a href="<?php echo $_SERVER['PHP_SELF']; ?>?checkout='true'">Check Out</a></p>
                                                                                                                                </body>
                                                                                                                                      </html>
