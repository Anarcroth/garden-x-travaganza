<?php
session_start();

	// Set items for sale and their prices
	$items = array('Item 1','Item 2','Item 3','Item 4');

	$prices = array( 24.95, 17.85, 19.99, 34.95 );
	
// Check if shopping cart exists or not as SESSION array
if (!isset($_SESSION['cart'])) 
	{
		// No, so create empty cart as a PHP SESSION array
		$_SESSION['cart'] = array();
	}

// Check if an item to buy has been clicked
if (isset($_GET['buy']))
	{
	// Add item to the end of the $_SESSION['cart'] array 
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
	// Display catalogue items for sale in a table
	echo '<table border="1">';
	for ($i = 0; $i < count($items); $i++) {
		// Generate table rows
		echo '<tr>';

		echo '<td>' . $items[$i] . '</td>';
		echo '<td>$' . $prices[$i] . '</td>';

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



