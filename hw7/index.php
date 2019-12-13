<?php
session_start();
if ($_GET['exit']) {
  session_destroy();
  header('Location: index.php?login.php');
}

require_once('views/header.php');
require_once('model/functions.php');

$db = SQL::Instance();

if (!$_SESSION['login']) require_once('views/login.php');
elseif ($_GET['page'] == 'contacts') require_once('views/contacts.php');
elseif ($_GET['page'] == 'catalog') {
  $products = $db->Select('products');
  require_once('views/catalog.php');
} elseif ($_GET['page'] == 'admin') {
  require_once('views/admin.php');
} elseif ($_GET['page'] == 'orders') {
  require_once('views/orders.php');
} elseif ($_GET['page'] == 'welcome') {
  require_once('views/welcome.php');
} elseif ($_GET['page'] == 'cart') {
  require_once('views/cart.php');
} elseif ($_GET['page'] == 'login') {
  require_once('views/login.php');
} elseif ($_GET['page'] == 'registration') {
  require_once('views/registration.php');
} elseif ($_GET['page'] == 'product') {
  extract($db->Select('products', 'id', $_GET['id']));
  require_once('views/product.php');
} else
  require_once('views/home.php');

require_once('views/footer.php');
