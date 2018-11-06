<?php
session_start();
// Check if user wants to end session and empty cart
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
	$items = array('Item 1','Item 2','Item 3','Item 4');

	$prices = array( 24.95, 17.85, 19.99, 34.95 );

	$totalItems = count($_SESSION['cart']);
	$totalCost = 0.00;
	
// Loop over items in shopping cart
for ($i = 0; $i < $totalItems; $i++) {
	echo '<tr>';

	echo '<td>' . $items[$_SESSION['cart'][$i]] . '</td>'; 
	echo '<td>' . $prices[$_SESSION['cart'][$i]] . '</td>'; 
	
	echo '</tr>';
	
	$totalCost = $totalCost + $prices[$_SESSION['cart'][$i]];
}
echo '</table>';

echo 'Total items bought= ' . $totalItems . '<br />';
echo 'Total cost of items bought= ' . $totalCost;

?>

<p><a href="showCatalogue.php">Continue Shopping</a> or <a href="<?php echo $_SERVER['PHP_SELF']; ?>?checkout='true'">Check Out</a></p>
</body>
</html>

