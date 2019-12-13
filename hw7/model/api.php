<?php
require_once('functions.php');
extract($_POST);

$query = "SELECT * FROM `products` WHERE `id`>'$start' LIMIT $limit";

$products = queryD($connection, $query);

echo json_encode($products);