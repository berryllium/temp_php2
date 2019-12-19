<?php
require_once('models/Catalog.php');
require_once('models/Cart.php');
$cart = new Cart($_SESSION['login']);
$catalog = new Catalog();
if (isset($_POST['id'])) $prod_id = $_POST['id'];
if ($_POST['act'] == 'add') {
  $cart->addProduct($prod_id);
} elseif ($_GET['act'] == 'del') {
  $cart->removeProduct($_GET['id']);
} elseif ($_GET['act'] == 'add') {
  $cart->addProduct($_GET['id']);
} elseif ($_GET['act'] == 'order') {
  $cart->Order();
}
$products = [];
foreach ($cart->getUserCart() as $k => $v) {
  $product = $catalog->getProduct($v['id_prod']);
  $product['count'] = $v['count'];
  $products[] = $product;
}
$data = array('cart' => $products);
