<?php
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
