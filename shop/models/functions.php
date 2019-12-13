<?php
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

    // $small = PATH_ROOT . $product['path_small'];
    // $big = PATH_ROOT . $product['path_big'];
    // if (file_exists($small)) unlink($small);
    // if (file_exists($big)) unlink($big);
    header('Location: ../index.php?page=catalog');
}