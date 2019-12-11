<?php
session_start();
if (!$_SESSION['login'] == 'admin') {
  haeder('Location: ../');
  exit;
}
require_once('functions.php');

if (isset($_POST['action'])) {
  $action = $_POST['action'];
  if ($action == 'create' || $action == 'update') {
    extract($_POST);
    $product = [
      'id' => $id,
      'title' => $title,
      'category' => $category,
      'short_desc' => $short,
      'full_desc' => $full,
      'price' => $price,
      'complect' => $complect
    ];
    $photo = $_FILES['photo'];
    if ($photo['tmp_name']) {
      $photo_name = substr(md5_file($photo['tmp_name']), -10) . '_' . translit($photo['name']);
      $path_big = 'img/big/';
      $path_small = 'img/small/';
      $mas = ['image/jpeg', 'image/png', 'image/gif'];
      if (in_array($photo['type'], $mas)) {
        if (move_uploaded_file($photo['tmp_name'], PATH_ROOT . $path_big . $photo_name)) {
          imageresize(PATH_ROOT . $path_small . $photo_name, PATH_ROOT . $path_big . $photo_name, 400, 250, 75);
          $big = $path_big . $photo_name;
          $small = $path_small . $photo_name;
          $product['path_big'] = $big;
          $product['path_small'] = $small;
          if ($action == 'update') {
            updateProduct($connection, $product);
          } else addProduct($connection, $product);
        }
      } else echo 'Можно загрузить только изображения в формате .jpg, .png или .gif';
    } else updateProduct($connection, $product);
  }
}
if ($_GET['action'] == 'delete') {
  $id = $_GET['id'];
  removeProduct($connection, $id);
}
