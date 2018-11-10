<?php
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
$catalogue = [];
$items = [];
$ids = [];
$prices = [];
$descriptions = [];
$imgPaths = [];
$codes = [];

try {
    $servername = "127.0.0.1";
    $dbname = "garden_x_travaganza";
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $user = "martin";
    $pass = "me4kaikop4e";

    $conn = new PDO($dsn, $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $selectAllItems = "SELECT * FROM catalogue";
    $catalogue = $conn->query($selectAllItems);

} catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
}

foreach ($catalogue as $i) {
    $items[] = $i['item'];
    $ids[] = $i['id'];
    $prices[] = $i['price'];
    $descriptions[] = $i['description'];
    $imgPaths[] = $i['imgpath'];
}

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
