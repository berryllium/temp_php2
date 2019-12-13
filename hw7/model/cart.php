<?php
session_start();
require_once('functions.php');
$login = $_SESSION['login'];

if(isset($_POST['id'])) {
  $id = $_POST['id'];
  if (isset($_POST['quantity'])) {
    addToCart($connection, $id, $login);
  } else removeFromCart($connection, $id, $login);
}

if(isset($_POST['login'])) {
  $login = $_POST['login'];
  $cart = json_encode(getUserCart($connection, $login));
  $query = "INSERT INTO `orders` (`login`, `cart`) VALUES ('$login', '$cart')";
  mysqli_query($connection, $query);
  cleanUserCart($connection, $login);
  echo "заказ $login оформлен";
}
