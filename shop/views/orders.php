<?php if ($_SESSION['login'] != admin) {
  echo 'Вы - не администратор сайта';
  exit;
}
require_once('model/functions.php');
$orders = getAllOrders($connection);
$count = 1;
?>

<table id="orders-table">
  <tr>
    <th>№</th>
    <th>id</th>
    <th>Покупатель</th>
    <th>Товары</th>
  </tr>
<?php foreach($orders as $order) : ?>
  <tr>
    <td><?= $count++ ?></td>
    <td><?= $order['id'] ?></td>
    <td><?= $order['login'] ?></td>
    <td><?= $order['cart'] ?></td>
  </tr>
<?php endforeach; ?>
</table>