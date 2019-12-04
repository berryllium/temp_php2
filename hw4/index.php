<?php
session_start();
if ($_GET['exit']) {
  session_destroy();
  header('Location: index.php?login.php');
}

require_once('views/header.php');
require_once('model/functions.php');
if (!$_SESSION['login']) require_once('views/login.php');
elseif ($_GET['page'] == 'contacts') require_once('views/contacts.php');
elseif ($_GET['page'] == 'catalog') {
  $query = "SELECT * FROM `products`";
  $products = query($connection, $query);
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
  $query = "SELECT * FROM `products` WHERE `id` = '" . $_GET['id'] . "'";
  extract(query($connection, $query)[0]);
  require_once('views/product.php');
} else
  require_once('views/home.php');

require_once('views/footer.php');
