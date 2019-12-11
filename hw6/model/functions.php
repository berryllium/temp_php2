<?php
require_once('SQL.php');
define('PATH_ROOT', '../');
$db = SQL::Instance();

function translit($str)
{
    $arr = ['а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => '', ' ' => '_'];
    preg_match_all('/./u', $str, $matches);
    $str = $matches[0];
    $result = [];

    foreach ($str as $symbol) {
        foreach ($arr as $t_symbol => $value) {
            if ($t_symbol == $symbol) $symbol = $value;
        }
        $result[] = $symbol;
    }
    $result = implode($result);
    return $result;
}

// создание уменьшенной копии
function imageresize($outfile, $infile, $neww, $newh, $quality)
{
    $im = imagecreatefromjpeg($infile);
    $k1 = $neww / imagesx($im);
    $k2 = $newh / imagesy($im);
    $k = $k1 > $k2 ? $k2 : $k1;

    $w = intval(imagesx($im) * $k);
    $h = intval(imagesy($im) * $k);

    $im1 = imagecreatetruecolor($w, $h);
    imagecopyresampled($im1, $im, 0, 0, 0, 0, $w, $h, imagesx($im), imagesy($im));

    imagejpeg($im1, $outfile, $quality);
    imagedestroy($im);
    imagedestroy($im1);
}

function addProduct($db, $product)
{
    $db->Insert('products', $product);
    header('Location: ../index.php?page=product&id=' . $product['id']);
}

function updateProduct($db, $product)
{
    $db->Update('products', $product, 'id=' . $product['id']);
    header('Location: ../index.php?page=product&id=' . $product['id']);
}

function removeProduct($db, $id)
{
    $product = $db->Select('products', "id=$id");
    $db->Delete('products', "id=$id");

    $small = PATH_ROOT . $product['path_small'];
    $big = PATH_ROOT . $product['path_big'];
    if (file_exists($small)) unlink($small);
    if (file_exists($big)) unlink($big);
    header('Location: ../index.php?page=catalog');
}


// function removeFromCart($db, $id, $login)
// {
//     $cart = getUserCart($db, $login);
//     if ($cart->$id > 1) $cart->$id--;
//     else unset($cart->$id);
//     $cart = json_encode($cart);
//     $query = "UPDATE `users` SET `cart` = '$cart' WHERE `login` = '$login'";
//     mysqli_query($connection, $query);
// }

// function addToCart($connection, $id, $login)
// {
//     echo $_SESSION['login'];
//     $cart = getUserCart($connection, $login);
//     if (isset($cart->$id)) $cart->$id++;
//     else $cart->$id = 1;
//     $cart = json_encode($cart);
//     $query = "UPDATE `users` SET `cart` = '$cart' WHERE `login` = '$login'";
//     mysqli_query($connection, $query);
// }

// function getUserCart($connection, $login)
// {
//     $query = "SELECT `cart` FROM `users` WHERE `login` = '$login'";
//     $result = mysqli_query($connection, $query);
//     $row = mysqli_fetch_assoc($result);
//     $data = $row['cart'];
//     return json_decode($data);
// }

// function cleanUserCart($connection, $login)
// {
//     $query = "UPDATE `users` SET `cart` = '{}' WHERE `login` = '$login'";
//     mysqli_query($connection, $query);
// }

// function getAllOrders($connection)
// {
//     $query = "SELECT * FROM `orders`";
//     $orders = query($connection, $query);
//     $data = [];
//     foreach ($orders as $key => $value) {
//         $id = $value['id'];
//         $login = $value['login'];
//         $cart = json_decode($value['cart']);
//         $cart_products = '';
//         foreach ($cart as $id_prod => $count) {
//             $query = "SELECT `title` FROM `products` WHERE `id` = '$id_prod'";
//             $product = query($connection, $query)[0]['title'];
//             $cart_products .= "$product - $count шт. ";
//         }
//         $order = [
//             'id' => $id,
//             'login' => $login,
//             'cart' => $cart_products
//         ];
//         $data[] = $order;
//     }
//     return $data;
// }
