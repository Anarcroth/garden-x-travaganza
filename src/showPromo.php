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

        $_SESSION['codeMesg'] = "Success!<br>"."You get a " . $dbCode[0]['item'] . " for FREE!!<br>"."You can now <a href='showCart.php'>continue shopping</a> more or go to the <a href='showCart.php'>cart</a>";
    } else {
        redirect($_SERVER['PHP_SELF']);
    }
}
?>

<html>

    <title>Index</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="loginstyle.php">

<body>
<form action="" method="post">
    <div class="login">
    <div class="login-form">
    <div class="control-group">
    <input class="input" name="promoCode" placeholder="Please Enter Code" type="text" value="<?php if (isset($_POST['submitPromoCode'])) echo $_POST['promoCode']; ?>"/>
    <label class="login-field-icon fui-lock" for="login-pass"></label>
    <div class="app-title">
    <h1><?php echo $_SESSION['codeMesg']; ?></h1>
    </div>
    </div>
    <button class="btn btn-primary btn-large btn-block" type="submit" name="submitPromoCode">Go!</button>
    </div>
    </div>
</form>
</body>
</html>
