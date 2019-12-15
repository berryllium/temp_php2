<?php
require_once('models/Catalog.php');
require_once('models/Cart.php');
$cart = new Cart($_SESSION['login']);
$catalog = new Catalog();
if (isset($_POST['id'])) $prod_id = $_POST['id'];
if ($_POST['act'] == 'add') {
  $cart->addProduct($prod_id);
} elseif ($_POST['act'] == 'del') {
  $cart->removeProduct($prod_id);
}
$products = [];
// print_r($cart->getUserCart());
foreach ($cart->getUserCart() as $k => $v) {
  $products[] = $catalog->getProduct($v['id']);
}