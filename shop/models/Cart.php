<?php
class Cart
{
  function __construct($login)
  {
    $this->db = SQL::Instance();
    $this->user = $this->db->Select('users', 'login', $login)['id'];
  }
  public function getBuy($id_prod)
  {
    return $this->db->CompositeQuery("SELECT * FROM `cart` WHERE `id_prod` = $id_prod AND `id_user` = $this->user");
  }
  public function getUserCart()
  {
    return $this->db->Select('cart', 'id_user', $this->user, true);
  }
  public function addProduct($id_prod)
  {
    $buy = $this->getBuy($id_prod);
    if ($buy) {
      $buy['count']++;
      $this->db->Update('cart', $buy, 'id', $buy['id']);
    } else $this->db->Insert('cart', ['id_user' => $this->user, 'id_prod' => $id_prod, 'count' => '1']);
  }
  public function removeProduct($id_prod)
  {
    $buy = $this->getBuy($id_prod);
    if ($buy['count'] > 1) {
      $buy['count']--;
      $this->db->Update('cart', $buy, 'id', $buy['id']);
    } else $this->db->Delete('cart', $buy, 'id', $buy['id']);
  }
}
