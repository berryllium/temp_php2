<?php
class Catalog {
  function __construct()
  {
    $this->db = SQL::Instance();
  }
	public function getAll() {
    return $this->db->Select('products');
  }
  public function getProduct($id) {
    return $this->db->Select('products', 'id', $id);
  }
}