<?php
require_once('models/Catalog.php');
require_once('models/Cart.php');
$cart = new Cart($_SESSION['login']);
$catalog = new Catalog();
if (isset($_GET['id'])) $prod_id = $_GET['id'];
if ($act == 'add') {
  $cart->addProduct($id);
} elseif ($act == 'del') {
  $cart->removeProduct($id);
}
$products = [];
print_r($cart->getUserCart());
foreach ($cart->getUserCart() as $k => $v) {
  $products[] = $catalog->getProduct($v['id']);
}