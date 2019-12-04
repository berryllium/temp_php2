<div class="cart-wrap">
  <?php
  $cart_poducts = [];
  require_once('model/cart.php');
  $cart = getUserCart($connection, $login);
  foreach ($cart as $key => $value) {
    $id = $key;
    $query = "SELECT * FROM `products` WHERE `id` = '$id'";

    $product = query($connection, $query)[0];
    $product['count'] = $value;
    $cart_poducts[] = $product;
  }
  foreach ($cart_poducts as $product) :
    ?>
    <div class="cart-item">
      <img src="<?= $product['path_small'] ?>" alt="photo">
      <div class="name"><?= $product['title'] ?></div>
      <div class="count"><?= $product['count'] ?></div>
      <a href="#" class="button" onclick="rem(event)" data-id="<?= $product['id'] ?>">&times;</a>
    </div>
  <?php endforeach; ?>
  <br>

</div>
<a href="#" data-login="<?= $_SESSION['login'] ?>" onclick="order(event)" class="button" id="order">Оформить</a>
<script>
  function rem(event) {
    id = event.target.dataset.id
    $.post("model/cart.php", {
        id: id
      })
      .done(function(data) {
        window.location = "index.php?page=cart";
      });
  }

  function order(event) {
    login = event.target.dataset.login
    $.post("model/cart.php", {
        login: login
      })
      .done(function(data) {
        alert(data);
        window.location = "index.php?page=catalog";
      });
  }
</script>