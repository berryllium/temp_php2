
<?php
require_once 'engine/connection.php';
function get_photo($connection)
{
  //получаем информацию об одиночном изображении

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query1 = "UPDATE `images` SET `rating` = `rating`+1 WHERE `images`.`id` = $id";
    $query2 = "SELECT * FROM images WHERE id=$id";
    $result = mysqli_query($connection, $query1);
    $result = mysqli_query($connection, $query2);
    $arr_photo = mysqli_fetch_assoc($result);
  } else {

    //получаем всю галерею

    $query = 'SELECT * FROM images';
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $arr_photo[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'path_big' => $row['path_big'],
        'path_small' => $row['path_small'],
        'rating' => $row['rating']
      ];
    }
    // сортировка по количеству просмотров
    usort($arr_photo,  function ($a, $b) {
      if ($a['rating'] == $b['rating']) {
        return 0;
      }
      return ($a['rating'] < $b['rating']) ? -1 : 1;
    });
  }
  return $arr_photo;
}
