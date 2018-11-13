<?php
require "pdo.php";
require "promo.php";
require "redirect.php";

session_start();

$prom = new promo($pdo);

if (isset($_POST['submitPromoCode'])) {
    $dbCode = $prom->getItemByCode($_POST['promoCode']);
    if ($dbCode != null) {
        $_SESSION['promoCart'][$dbCode[0]['item']] = "FREE";

        echo "Success! ";
        echo "You get a " . $dbCode[0]['item'] . " for FREE!!<br>";
        echo "You can now <a href='showCart.php'>continue shopping</a> more or go to the <a href='showCart.php'>cart</a>";
    } else {
        redirect($_SERVER['PHP_SELF']);
    }
}
?>

<html>
<body>
<div>
<form action="" method="post">
  <label><b>Promo Code</b></label>
                      <input type="text" placeholder="Enter code" name="promoCode" value="<?php if (isset($_POST['submitPromoCode'])) echo $_POST['promoCode']; ?> "/>
    <button type="submit" name="submitPromoCode">Go!</button>
</div>
</body>
</html>
