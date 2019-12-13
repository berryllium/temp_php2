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
      if ($act == 'login') {
        require_once('models/User.php');
        $user = new User($db, $_POST['login'], $_POST['pass']);
        if ($user->auth()) {
          $login = $_SESSION['login'] = $user->getLogin();
          $isAdmin = true;
          $view = 'v_welcome.tmpl';
        } else {
          $view = 'v_login.tmpl';
          $data = array('correct' => false);
        }
      } else {
        $view = 'v_login.tmpl';
        $data = array('correct' => true);
      }
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
      require_once('models/Catalog.php');
      $catalog = new Catalog($db);
      if ($act == 'del') {
        $catalog->removeProduct($id_prod);
        $data = array('products' => $catalog->getAll());
        $view = 'v_catalog.tmpl';
      } elseif ($act == 'edit') {
        $catalog->updateProduct($_POST, $_FILES);
        $data = $catalog->getProduct($id_prod);
        $view = 'v_product.tmpl';
      } elseif ($act == 'add') {
        $id = $catalog->addProduct($_POST, $_FILES);
        $data = $catalog->getProduct($id);
        $view = 'v_product.tmpl';
      } else {
        $data = $catalog->getProduct($id_prod);
        $view = 'v_product.tmpl';
      }
      $data['isAdmin'] = $isAdmin;
      break;
    }
  case 'cart': {
      $view = 'v_cart.tmpl';
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
