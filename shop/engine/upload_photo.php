<?php
require_once('connection.php');
function imageresize($outfile,$infile,$neww,$newh,$quality) {
    $im=imagecreatefromjpeg($infile);
    $k1=$neww/imagesx($im);
    $k2=$newh/imagesy($im);
    $k=$k1>$k2?$k2:$k1;

    $w=intval(imagesx($im)*$k);
    $h=intval(imagesy($im)*$k);

    $im1=imagecreatetruecolor($w,$h);
    imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

    imagejpeg($im1,$outfile,$quality);
    imagedestroy($im);
    imagedestroy($im1);
    }


$mas = ['image/jpeg','image/png','image/gif'];
$photo = $_FILES['photo'];
$root = '../';
$path_big = 'data/images/big/';
$path_small = 'data/images/small/';
if(in_array($photo['type'], $mas)) {
    if (move_uploaded_file($photo['tmp_name'],$root.$path_big.$photo['name'])) {
        imageresize($root.$path_small.$photo['name'],$root.$path_big.$photo['name'],320,320,75);
        $title = $photo['name'];
        $big = $path_big.$photo['name'];
        $small = $path_small.$photo['name'];
        $query = "INSERT INTO `images` (`id`, `title`, `path_big`, `path_small`, `rating`) VALUES (NULL, '$title', '$big', '$small', '0');";
        $result = mysqli_query($connection, $query);
        if($result) header("Location: /hw5/index.php");
        else echo 'Ошибка записи в БД';
    }
}
else echo 'Можно загрузить только изображения в формате .jpg, .png или .gif';

