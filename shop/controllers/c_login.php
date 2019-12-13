<?php
require_once '../models/User.php';
echo 'test';
if (isset($_POST['login']) && isset($_POST['pass'])) {
echo 'post';
$login = $_POST['login'];
$pass = $_POST['pass'];

$user = new User($db, $login, $pass);
    
    if ($user->auth()) {
      echo 'зашел';
    } else echo 'не зашел';

    // if ((md5($pass . $sault) == $user['pass'])) {
    //     $_SESSION['login'] = $user['login'];
    //     echo '<script>document.location.href = "index.php?page=welcome";</script>';
    //     exit;
    // } else {
    //     echo '<p>Логин или пароль неверны!</p>';
    // }

if ($_SESSION['login']) {
    echo '<script>document.location.href = "index.php?page=welcome";</script>';
    exit;
}
}
