<?php

session_start();
if ($_GET['exit']) {
  session_destroy();
  header('Location: index.php?login.php');
}
echo $_SESSION['login'] . ' login';
require_once('models/functions.php');
$login = $_SESSION['login'];
$isAdmin = $login == 'admin' ? true : false;

$data = [];

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$act = $_GET['act'];
$id_prod = $_GET['id'];

switch ($page) {
  case '': {
      $view = 'v_home.tmpl';
      break;
    }
  case 'login': {
      require_once('controllers/c_user.php');
      break;
    }
  case 'catalog': {
      $view = 'v_catalog.tmpl';
      require_once('models/Catalog.php');
      $catalog = new Catalog($db);
      $data = array('products' => $catalog->getAll());
      break;
    }
  case 'product': {
      require_once('controllers/c_catalog.php');
      $data['isAdmin'] = $isAdmin;
      break;
    }
  case 'cart': {
      require_once('controllers/c_cart.php');
      $view = 'v_cart.tmpl';
      $data['cart'] = $products;
      break;
    }
  case 'contacts': {
      $view = 'v_contacts.tmpl';
      break;
    }
  case 'admin': {
      $view = 'v_admin.tmpl';
      $data = array('isAdmin' => $isAdmin);
      break;
    }
  default: {
      $view = 'v_home.tmpl';
      break;
    }
}


$content = $twig->loadTemplate($view);

echo $header->render(array(
  'login' => $login,
  'isAdmin' => $isAdmin
));

echo $content->render($data);


echo $footer->render(array());