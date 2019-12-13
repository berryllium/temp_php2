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
  public function addProduct($post, $files) {
    $product = $this->prepareProduct($post, $files);
    return $this->db->Insert('products', $product);
  }
  public function updateProduct($post, $files) {
    $product = $this->prepareProduct($post, $files);
    return $this->db->Update('products', $product, 'id', $product['id']);
    
  }
  public function removeProduct($id) {
    $this->db->Delete('products', 'id', $id);
  }
  public function prepareProduct($post, $files) {
    extract($post);
    $product = [
      'title' => $title,
      'category' => $category,
      'short_desc' => $short_desc,
      'full_desc' => $full_desc,
      'price' => $price,
      'complect' => $complect
    ];
    if($id) $product['id'] = $id;
    $photo = $files['photo'];
    if ($photo['tmp_name']) {
      $photo_name = substr(md5_file($photo['tmp_name']), -10) . '_' . translit($photo['name']);
      $path_big = 'img/big/';
      $path_small = 'img/small/';
      $mas = ['image/jpeg', 'image/png', 'image/gif'];
      if (in_array($photo['type'], $mas)) {
        if (move_uploaded_file($photo['tmp_name'], $path_big . $photo_name)) {
          imageresize($path_small . $photo_name, $path_big . $photo_name, 400, 250, 75);
          $big = $path_big . $photo_name;
          $small = $path_small . $photo_name;
          $product['path_big'] = $big;
          $product['path_small'] = $small;
        }
      } else return 'Можно загрузить только изображения в формате .jpg, .png или .gif';
    } return $product;
  }
}