<?php
session_start();

$catalogue = [];
$items = [];
$ids = [];
$prices = [];
$descriptions = [];
$imgPaths = [];
$codes = [];

try {
    // TODO set this object into a session or a separate file that would be called when needed
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
