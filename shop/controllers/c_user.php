<?php
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
